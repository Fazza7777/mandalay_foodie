<?php
class DB{
    private static $dbh;
    private static $stmt,$data,$count,$sql;
    public function __construct()
    {
        self::$dbh = new PDO("mysql:host=localhost;dbname=mandalay_foodie","root","");
        self::$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    public function query($param=[]){
        self::$stmt = self::$dbh->prepare(self::$sql);
        self::$stmt->execute($param);     
        return $this;
    }
    public function get(){
        $this->query();
        self::$data = self::$stmt->fetchAll(PDO::FETCH_OBJ);
        return self::$data;
    }
    public function first(){
        $this->query();
        self::$data = self::$stmt->fetch(PDO::FETCH_OBJ);
        return self::$data;
    }
    public function count(){
        $this->query();
        self::$count = self::$stmt->rowCount();
        return self::$count;
    }
    public static function table($table){
        self::$sql = "select * from $table";
        $db = new DB();
        // $db->query(); // not require 
        return $db; // same like $this
    }
    public function orderBy($col,$type){
       self::$sql .=" order by $col $type";
       $this->query();
       return $this;
    }

    public function where($col,$operator,$val=""){
        if(func_num_args() == 2){
            self::$sql .= " where $col='$operator'";
        }else{
            self::$sql .= " where $col $operator '$val'";
        }
        return $this;
    }
    public function andWhere($col,$operator,$val=""){
        if(func_num_args()==2){
            self::$sql .= " and $col='$operator'";
        }else{
            self::$sql.=" and $col $operator '$val'";
        }
        return $this;
    }
    public function orWhere($col,$operator,$val=""){
        if(func_num_args()==2){
            self::$sql .= " or $col='$operator'";
        }else{
            self::$sql .= " or $col $operator '$val'";
        }
        //echo self::$sql;
        return $this;
    }
    public static function create($table,$data){
       $col = implode(",",array_keys($data));
       $value = "";
       $cond = 1;
       foreach($data as $d){
           $value .= "?";
           if($cond < count($data)){
               $value .=",";
               $cond++;
           }
       }
        $db = new DB();
        self::$sql = "insert into $table ($col) values ($value)";
        $value = array_values($data);
        $db->query($value);
        $id = self::$dbh->lastInsertId();
        return DB::table($table)->where("id",$id)->first();
    }
    public static function update($table,$data,$id){
        $db = new DB();
        $value = "";
        $cond = 1;
        foreach($data as $k=>$d){
            $value .= "$k=?";
            if($cond < count($data)){
                $value .=",";
                $cond++;
            }
        }
        self::$sql = "update $table set $value where id=$id";
        $db->query(array_values($data));
        return DB::table($table)->where("id",$id)->first();
    }
    public static function delete($table,$id){
        $deleteData = DB::table($table)->where("id",$id)->first();
         $db = new DB();
         self::$sql = "delete from $table where id=$id";
         $db->query();
         return $deleteData;
    }
    public function paginate($record_per_page,$append=""){
        if(!isset($_GET["page"])){
            $page_no = $_GET["page"] = 1;
        }else if($_GET["page"] < 1){
            $page_no = 1;
        }else{
            $page_no = $_GET["page"];
        }
      // get Total count
          $this->query();
         $totalCount = self::$stmt->rowCount();
         $index = ($page_no - 1) * $record_per_page;
         self::$sql.= " limit $index,$record_per_page";
         self::$data = $this->get();
       //Next Prev  
         $prev_no = $page_no-1;
         $next_no = $page_no+1;
         $prev_page = "?page=".$prev_no."&".$append;
         $next_page = "?page=".$next_no."&".$append;
         $allData = [
             'data'=>self::$data,
             'total'=>$totalCount,
             'prev_page'=>$prev_page,
             'next_page'=>$next_page        
         ];
         return $allData;
    }
    public static function raw($sql){
        $db = new DB();
        self::$sql = $sql;
        return $db;
    }
}
