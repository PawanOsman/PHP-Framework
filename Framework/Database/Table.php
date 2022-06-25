<?php
class Table{
  protected $database;
  protected $connection;
  public $name;
  private $QueryString = false;
	public function __construct($database, $tablename)
  {
		$this->database = $database;
		$this->connection = $database->connection;
		$this->name = $tablename;
		if ($this->connection->connect_error) {
			die('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}
	}

  public function GetMany($ChildName, $ColumnName)
  {
    $QueryResult = $this->connection->query("SELECT b.* FROM {$this->name} a LEFT JOIN {$ChildName} b ON a.id = b.{$ColumnName}");
    $ResultArray = array();
    if ($QueryResult->num_rows > 0) {
        while($row = $QueryResult->fetch_assoc()) {
            $ResultArray[] = $row;
        }
    }
    return Linq::From($ResultArray);
  }

  public function Join($ChildName, $ColumnName, $Columns = false)
  {
    $Columns = ($Columns == false) ? "a.*" : ((count($Columns) == 1) ? $Columns[0] : join(", a.", $Columns));
    $this->QueryString = "";
    $this->QueryString .= "SELECT {$Columns} FROM {$this->name} a JOIN {$ChildName} b ON a.id = b.{$ColumnName}";
    return $this;
  }

  public function GetAll($Columns = false)
  {
    $Columns = ($Columns == false) ? "*" : join(", ", $Columns);
    $QueryResult = $this->connection->query("SELECT {$Columns} FROM {$this->name}");
    $ResultArray = array();
    if ($QueryResult->num_rows > 0) {
        while($row = $QueryResult->fetch_assoc()) {
            $ResultArray[] = $row;
        }
    }
    return Linq::From($ResultArray);
  }

  public function Select($Columns = false)
  {
    $Columns = ($Columns == false) ? "*" : ((count($Columns) == 1) ? $Columns[0] : join(", ", $Columns));
    $this->QueryString = "";
    $this->QueryString .= "SELECT {$Columns} FROM {$this->name}";
    return $this;
  }

  public function Where($Column, $Condition, $Value)
  {
    $this->QueryString .= " WHERE {$Column} {$Condition} '{$this->database->Escape($Value)}'";
    return $this;
  }

  public function And($Column, $Condition, $Value)
  {
    $this->QueryString .= " AND {$Column} {$Condition} '{$this->database->Escape($Value)}'";
    return $this;
  }

  public function Or($Column, $Condition, $Value)
  {
    $this->QueryString .= " OR {$Column} {$Condition} '{$this->database->Escape($Value)}'";
    return $this;
  }

  public function Limit($Limit, $Offset = false)
  {
    $Offset = ($Offset) ? "{$Offset}, " : "";
    $this->QueryString .= " LIMIT {$Offset}{$Limit}";
    return $this;
  }

  public function Order($Columns, $Sort = false)
  {
    $OrderBy = array();
    for($i = 0; $i <= (Count($Columns)-1); $i++)
    {
      $OrderBy[] = ($Sort != false AND isset($Sort[$i]) AND $Sort[$i] != false) ? "{$Columns[$i]} {$Sort[$i]}" : "{$Columns[$i]}";
    }
    $OrderBy = join(", ", $OrderBy);
    $this->QueryString .= " ORDER BY {$OrderBy}";
    return $this;
  }

  public function Get()
  {
    $QueryResult = $this->connection->query($this->QueryString);
    $ResultArray = array();
    if ($QueryResult->num_rows > 0) {
        while($row = $QueryResult->fetch_assoc()) {
            $ResultArray[] = $row;
        }
    }
    $this->QueryString = false;
    return Linq::From($ResultArray);
  }

  public function Any()
  {
    $QueryResult = $this->connection->query($this->QueryString);
    $ResultArray = array();
    if ($QueryResult->num_rows > 0) {
        return true;
    }
    $this->QueryString = false;
    return false;
  }

  public function Insert($row)
  {
    $Columns = "";
    $Values = "";
    $First = true;
    foreach($row as $Column => $Value) {
      $Columns .= ($First) ? "{$Column}" : ", {$Column}";
      $Values .= ($First) ? "'{$this->database->Escape($Value)}'" : ", '{$this->database->Escape($Value)}'";
      $First = false;
    }
    $QueryResult = $this->connection->query("INSERT INTO {$this->name} ({$Columns}) VALUES ({$Values})");
    if ($QueryResult === TRUE) {
        return $this->connection->insert_id;
    }
    else {
      return $this->connection->error;
    }
  }

  public function InsertId()
  {
    return $this->connection->insert_id;
  }

  public function Update($Data)
  {
    $First = true;
    $this->QueryString = "";
    $this->QueryString .= "UPDATE {$this->name} SET ";
    foreach($Data as $Column => $Value) {
      $this->QueryString .= ($First) ? "{$Column}='{$this->database->Escape($Value)}'" : ", {$Column}='{$this->database->Escape($Value)}'";
      $First = false;
    }
    return $this;
  }

  public function Set()
  {
    $QueryResult = $this->connection->query($this->QueryString);
    if ($QueryResult === TRUE) {
        return TRUE;
    }
    else {
      return $this->connection->error;
    }
  }

  public function Echo()
  {
    return $this->QueryString;
  }

}
?>
