<?php
require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);

use App\Services\DomPdfService;
use App\Services\HtmlProcessor;


$html = file_get_contents('./original2.html', true);
$htmlprocesor = new HtmlProcessor($html);
$htmlprocesor->removeScriptTags();
$css = '
        @page {
			size: A4 portrait;
			margin: 0;
			margin-top: -30px;
			margin-bottom: none;
			margin-left: none;
			margin-right: none;
		}

		table.paging thead {
			top: -35px
		}

		table.paging thead td,
		table.paging tfoot td {
			height: .5in;
		}
		.page-break {
			display: block;
			page-break-before: always;
			page-break-inside: avoid;
		}

		.hides {
			display: none;
		}

		.middle {
			display: none;
		}

		header {
			position: fixed;
			top: 0;
		}
		footer {
			position: fixed;
			bottom: 10px;
			width: auto;
		}

		footer > * {
			font-size: 10px;
		}

        .server-page-break {
            page-break-before: always;
        }        
';
$htmlprocesor->addCss($css);
$html = $htmlprocesor->getProcessedHtml();

$domPdfService = new DomPdfService();
$domPdfService->generatePdf($html);