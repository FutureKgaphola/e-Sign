<?php
use Mpdf\Mpdf;

class Mpdf_lib {
    public $mpdf;

    public function __construct() {
        $this->$mpdf = new mPDF([
            'tempDir' => sys_get_temp_dir()
        ]);
    }

    public function generate($html, $filename = 'document.pdf') {
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($filename, 'I');
    }
}
