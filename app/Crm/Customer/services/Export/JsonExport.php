<?php

namespace Crm\Customer\services\Export;

class JsonExport implements ExportInterface
{
    public function export(array $data)
    {
        dd("json exporter");
    } 
}