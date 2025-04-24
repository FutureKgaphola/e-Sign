<?php
require_once BASEPATH . '/helpers/url_helper.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?php echo base_url().'/assets/css/styles.css'; ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <img src='../../public/assets/images/SITAlogo.gif' />

        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <span class="d-flex dropdown-item badge text-bg-dark">Welcome,
                <?= $this->session->userdata('username'); ?>
            </span>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <form action="<?php echo base_url('index.php/logout')?>" method="post">
                        <li><button type="submit" class="dropdown-item">Logout</button></li>
                    </form>
                </ul>
            </li>
        </ul>
    </nav>
        
        <div class='pt-5'>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">SITA e-sign</li>
                        
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Total users : <?= count( isset($users['data']) ? $users['data'] :[] ) ?></div>
                                <div class="card-footer d-flex flex-wrap gap-1">
                                    <span class="small text-white ">As Recorded</span>
                                    <span class="badge text-bg-warning">Permanent : <?= count(isset($users['permanent']) ? $users['permanent'] : []) ?></span>
                                    <span class="badge text-bg-light">Interns : <?= count(isset($users['intern']) ? $users['intern'] :[]) ?></span>
                                    <span class="badge text-bg-light">Interns : <?= count(isset($users['contractor']) ? $users['contractor'] :[]) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Late Today : <?=count(isset($users['late_intern']) ? $users['late_intern'] : []) + count(isset($users['late_permanent']) ? $users['late_permanent'] :[]) +count(isset($users['late_contractor']) ? $users['late_contractor'] :[])  ?></div>
                                <div class="card-footer d-flex flex-wrap gap-1">
                                    <span class="small text-white">As Recorded</span>
                                    <span class="badge text-bg-primary">Permanent : <?= count(isset($users['late_permanent']) ? $users['late_permanent'] :[]) ?></span>
                                    <span class="badge text-bg-light">Interns : <?= count(isset($users['late_intern']) ? $users['late_intern'] : []) ?></span>
                                    <span class="badge text-bg-light">Contractor : <?= count(isset($users['late_contractor']) ? $users['late_contractor'] : []) ?></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center gap-1">
                            <i class="fas fa-table me-1"></i>
                            Employees
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path
                                        d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                </svg>
                            </button>
                            <p style="color:red;"><?php echo ($this->session->userdata('error'));?> </p>
                            <?php  $this->session->unset_userdata('error');?>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Employee No</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Employment</th>
                                        <th>Atendence Today</th>
                                        <th>Created Date</th>
                                        <th>.....</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Employee No</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Employment</th>
                                        <th>Atendence Today</th>
                                        <th>Created Date</th>
                                        <th>.....</th>

                                    </tr>
                                </tfoot>
                                <?php require(APPPATH .'/devConstants/devConst.php') ?>
                                <tbody>
                                    <?php if(isset($users['data'])){
                                        
                                        foreach ($users['data'] as $emp): 
                                        ?>
                                        <tr>
                                            <td class="user_id">
                                                <?= $emp['emp_no'] ?>
                                            </td>
    
                                            <td>
                                                <?= $emp['name'] ?>
                                            </td>
    
                                            <td>
                                                <?= $emp['position'] ?>
                                            </td>
    
                                            <td>
                                                <?= $emp['empStatus'] ?>
                                            </td>
    
                                            <td>
                                                <div class="d-flex justify-content-between m-1 align-items-center">
                                                    <?php if ($emp['attendance'] === 'present'): ?>
                                                    <span class="badge text-bg-success" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Signed in at <?= $emp['signed_in'] ?>">In Today</span>
                                                    <?php else: ?>
                                                    <span class="badge text-bg-danger">Awaiting Sign In</span>
                                                    <?php endif; ?>
                                                    <a href="User/print_file/<?= $emp['emp_no'] ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
    
                                            <td>
                                                <?= $emp['created'] ?>
                                            </td>
    
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="#" class="btn btn-sm view_data btn-warning"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-userid="<?= $emp['emp_no'] ?>">Edit</a>
    
                                                    <a href="#" class="btn btn-sm delete_data btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdropDelete"
                                                        data-userid="<?= $emp['emp_no'] ?>">delete</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                   <?php } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <a target="_blank"
                                href="https://www.sita.co.za/">SITA</a> 2025</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    

    <?php require APPPATH . 'views/components/modal/addemployee.php'; ?>
    <?php require APPPATH . 'views/components/modal/editemployee.php'; ?>
    <?php require APPPATH . 'views/components/modal/deleteModal.php'; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="<?php echo base_url().'assets/js/scripts.js?v=2';?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="<?php echo base_url().'assets/js/datatables-simple-demo.js';?>"></script>


</body>

</html>