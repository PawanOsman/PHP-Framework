<?php
class LinqFactory{
  public $array;

  public function Count()
  {
    return count($this->array);
  }

  public function ToList()
  {
    return $this->array;
  }

  public function First()
  {
    return $this->array[0];
  }

  public function Last()
  {
    return $this->array[count($this->array) - 1];
  }

  public function OrderBy($column, $desc = false)
  {
    uasort($this->array, function ($a, $b) use ($column) {
      if (is_array($a)) {
        if ($a[$column] == $b[$column]) {
          return 0;
        }
        return ($a[$column] < $b[$column]) ? -1 : 1;
      } else {
        if ($a->$column == $b->$column) {
          return 0;
        }
        return ($a->$column < $b->$column) ? -1 : 1;
      }
    });
    if ($desc) {
      $this->Reverse();
    }
    return $this;
  }

  public function Distinct()
  {
    $this->array = array_unique($this->array, SORT_REGULAR);
    return $this;
  }

  public function Reverse()
  {
    $this->array = array_reverse($this->array, true);
    return $this;
  }

  public function Limit($offset, $length = null)
  {
    if (!$length) {
      $this->array = array_slice($this->array, 0, $offset);
      return $this;
    }
    $this->array = array_slice($this->array, $offset, $length);
    return $this;
  }

  public function Where(callable $condition)
  {
    if(!is_callable($condition)){
      throw new \Exception("parameter condition must by callable");
    }
    $this->array = array_filter($this->array, $condition);
    return $this;
  }

  public function Search($SearchValue)
  {
    $this->Where(function($Array) use ($SearchValue){
      $Result = false;
      foreach($Array as $Key => $Value)
      {
        if(preg_match("/{$SearchValue}/im", $Array[$Key]))
        {
          $Result = true;
        }
      }
      return $Result;
    });
    return $this;
  }

  public function Select($key = null, $key2 = null)
  {
    //call without parameters
    if (!$key) {
      return $this->array;
    }
    //first param is callable
    if(is_callable($key)){
      $array = $this->array;
      return array_map($key, $array);
    }

    else {
      //both params used
      if ($key2) {
        $firstKey = array_keys($this->array)[0];
        if (is_object($this->array[$firstKey])) {
          return array_map(function ($item) {
            return (object)$item;
          }, $this->Select($key2, $key));
        }
          return array_column($this->array, $key2, $key);
      }
      //only first param
      else {
        $firstKey = array_keys($this->array)[0];
        if (is_object($this->array[$firstKey])) {
          return array_map(function ($item) {
            return (object)$item;
          }, $this->Select($key, $key2));
        }
        return array_column($this->array, $key, null);
      }
    }
  }

}
class Linq{
  public static function From($array)
  {
    $LinqFactory = new LinqFactory();
    $LinqFactory->array = $array;
    return $LinqFactory;
  }
}

?>