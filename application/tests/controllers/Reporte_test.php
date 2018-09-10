<?php

	use PHPUnit\Framework\TestCase;
	use Application\Controllers\ReporteController;

	class Reporte_test extends TestCase {
		public function testReportExists() {
			$controller = new ReporteController();
			$controller->generarPDF();
			$this->assertFileExists("../../../ReporteRequisitos.pdf");
		}
	}
?>