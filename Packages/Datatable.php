<?php
class Datatable{
  public static function Generate($Columns, $Data, $Request)
  {
    // Count Total Records
    $TotalFilter = $Data->Count();

		// Search
		if(!empty($Request['search']['value'])){
      $Data = $Data->Search($Request['search']['value']);
		}

    // Count Total after Search Result
		$TotalData = $Data->Count();

    // Set Order By Column [ASC, DESC]
    $Data->OrderBy($Columns[$Request['order'][0]['column']], $Request['order'][0]['dir'] == "asc" ? false : true);

    // Limit Result for pagination purpose
    if($Request['length'] != -1)
    {
      $Data->Limit($Request['start'], $Request['length']);
    }

    // Get Result as array
		$DataArray = $Data->ToList();

		$DataResult = array();

    foreach($DataArray as $DataRow)
    {
      $Row = array();
      foreach ($DataRow as $Value) {
        $Row[] = $Value;
      }
      $DataResult[] = $DataRow;
    }

		$json_data=array(
			"draw"              =>  intval($Request['draw']),
			"recordsTotal"      =>  intval($TotalData),
			"recordsFiltered"   =>  intval($TotalFilter),
			"data"              =>  $DataResult
		);

		echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
  }
}
?>