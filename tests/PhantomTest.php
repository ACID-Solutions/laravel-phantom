<?php

use Mockery as m;
use AcidSolutions\LaravelPhantom\Phantom;

class InvoiceTest extends PHPUnit_Framework_TestCase {

	public function tearDown()
	{
		m::close();
	}

    public function testDownloadingInvoiceReturnsResponse()
	{
        $mm = m::mock('AcidSolutions\LaravelPhantom\PdfableInterface');
        $mm->id = 1;
        $mm->shouldReceive('pdfPrefix')->andReturn('devis_');

		$pdf = m::mock('AcidSolutions\LaravelPhantom\PdfPhantom[render,getPhantomProcess]', array($mm));

		$pdf->date = time();

		$workPath = realpath(__DIR__.'/../src/AcidSolutions/LaravelPhantom/work').'/'.md5(1).'.pdf';

		$pdf->shouldReceive('render')->once()->andReturn('rendered');

		$pdf->setFiles($files = m::mock('Illuminate\Filesystem\Filesystem'));

		$files->shouldReceive('put')->once()->with($workPath, 'rendered');

		$pdf->shouldReceive('getPhantomProcess')->once()->andReturn($process = m::mock('StdClass'));

        $process->shouldReceive('setTimeout')->once()->andReturn($process);
		$process->shouldReceive('run')->once();

		$files->shouldReceive('get')->once()->with($workPath)->andReturn('pdf-content');

		$pdf->download();
	}
}
