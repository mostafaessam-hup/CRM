<?php

use Crm\Customer\services\Export\ExcelExport;
use Crm\Customer\services\Export\HtmlExport;
use Crm\Customer\services\Export\JsonExport;
use Crm\Customer\services\Export\PdfExport;
use Crm\Customer\services\Export\XmlExport;

return [
    "exporters" => [
        "json"=>JsonExport::class,
        "pdf"=>PdfExport::class,
        "html"=>HtmlExport::class,
        "excel"=>ExcelExport::class,
        "xml"=>XmlExport::class,
    ]
];
