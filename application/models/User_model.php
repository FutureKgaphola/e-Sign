<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $pdo;

    public function __construct()
    {
        parent::__construct();
        require_once(APPPATH . 'libraries/PdoService.php');
        $pdoService = new PdoService();
        $this->pdo = $pdoService->getPDO();
    }

    public function get_all_users()
    {
        $sql = "SELECT * FROM Employees";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_user_by_id($id)
    {
        $sql = "SELECT * FROM Employees WHERE emp_no = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_user_employment($type='permanent')
    {
        $sql = "SELECT * FROM Employees WHERE empStatus = :empStatus";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['empStatus' => $type]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_late_intern()
    {
        $sql = "SELECT * FROM Employees WHERE attendance = :attendence AND empStatus = :empStatus";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['attendence' => 'absent', 'empStatus' => 'intern']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_late_permanent()
    {
        $sql = "SELECT * FROM Employees WHERE attendance = :attendence AND empStatus = :empStatus";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['attendence' => 'absent', 'empStatus' => 'permanent']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update_user($data) {
        $stmt = $this->pdo->prepare("UPDATE Employees 
        SET name = ? , position = ? , empStatus = ? 
         WHERE id = ? AND emp_no = ?");
        return $stmt->execute([$data['name'], $data['position'], $data['empStatus'], $data['id'], $data['emp_no']]);
    }

    public function update_signInRegister($emp_no) {


        $stmt = $this->pdo->prepare("UPDATE Employees 
        SET signed_in = NOW() , attendance= ?
        WHERE emp_no = ?");
        $success= $stmt->execute(['present',$emp_no]);
        if($success && $stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function update_signOutRegister($emp_no) {
        // Start a transaction to ensure consistency
        $this->pdo->beginTransaction();
    
        try {
            // Step 1: Update the original table
            $stmt = $this->pdo->prepare("UPDATE Employees 
                SET signed_out = NOW(), attendance = ? 
                WHERE emp_no = ?");
            $success = $stmt->execute(['absent', $emp_no]);
    
            if ($success && $stmt->rowCount() > 0) {
                // Step 2: Fetch the updated row
                $fetchStmt = $this->pdo->prepare("SELECT * FROM Employees WHERE emp_no = ?");
                $fetchStmt->execute([$emp_no]);
                $userData = $fetchStmt->fetch(PDO::FETCH_ASSOC);
    
                // Step 3: Insert into the backup table
                $insertStmt = $this->pdo->prepare("
                    INSERT INTO Employees_Backup (id, name,position, emp_no, attendance,signed_in, signed_out, empStatus)
                    VALUES (:id, :name, :position, :emp_no, :attendance, :signed_in, :signed_out, :empStatus)
                ");
                
                // Update this array based on your actual column names
                $insertSuccess = $insertStmt->execute([
                    ':id' => $userData['id'],
                    ':name' => $userData['name'],
                    ':position' => $userData['position'],
                    ':emp_no' => $userData['emp_no'],
                    ':attendance' => $userData['attendance'],
                    ':signed_in' => $userData['signed_in'],
                    ':signed_out' => $userData['signed_out'],
                    ':empStatus' => $userData['empStatus'],
                ]);
    
                if ($insertSuccess) {
                    $this->pdo->commit();
                    return true;
                }
            }
    
            // If something fails
            $this->pdo->rollBack();
            return false;
    
        } catch (Exception $e) {
            $this->pdo->rollBack();
            // Log or handle the error
            return false;
        }
    }
    

    public function add_user($data) {
        
            $stmt = $this->pdo->prepare("INSERT INTO Employees (name,position,empStatus,emp_no)
            VALUES (?,?,?,?)");
            $success = $stmt->execute([$data['name'], $data['position'], $data['empStatus'], $data['emp_no']]);
            if ($success) {
                return $this->pdo->lastInsertId();
            }
       
    }

    public function delete_user($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Employees WHERE emp_no = ?");
        return $stmt->execute([$id]);
    }
}
