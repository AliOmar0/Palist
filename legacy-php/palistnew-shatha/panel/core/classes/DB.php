<?php
class DB{
    public $where="!deleted";
    public $order='id DESC';
    public $limit=NULL;
    public $fields='*';
    public $params=[];

    public $mark=false;
    public $group=NULL;

    public $connection_index=0;

    //language
    public $lang=NULL;
    public $min_lang_char=3;
    public $lang_field='title';
    public $match=true;

    private $built_statement;

    //result
    public $count=0;
    public $data=[];

    function __construct(
        /**
         * @todo escape module?
         */
        public $module
    ){
    }

    private static function execute_statement($prepared_statement, $params=[]){
        if($prepared_statement === false){
            throw new Exception(mysqli_error($GLOBALS['conn']));
        }
        if(!empty($params)){
            $types='';
            $values=[];
            foreach($params as $key=>$value){
                if(is_int($value))$types.='i';
                elseif(is_float($value))$types.='d';
                else $types.='s';
                $values[$key]=$value;
            }

            $bind_params=[$types];
            foreach($values as $key=>&$value){
                $bind_params[]=&$value;
            }
            call_user_func_array([$prepared_statement,'bind_param'],$bind_params);
        }

        return $prepared_statement->execute();
    }


    
    
    function process(){
        global $conn;
        
        $group_phrase=$regex_phrase=NULL;

        if($this->lang!=NULL){
            if($this->lang=='ar')$regex='\'[ء-ي]{'.($this->match?$this->min_lang_char:1).',}\'';
            elseif($this->lang=='en')$regex='\'[a-zA-Z]{'.($this->match?$this->min_lang_char:1).',}\'';
            if($regex!=NULL){
                $regex_phrase=($this->where==NULL?' ':' AND ').$this->lang_field.($this->match?NULL:' NOT ').' REGEXP '.$regex;
            }
        }

        if($this->group!=NULL){
            $group_phrase=' GROUP BY '.$this->group;
        }

        $this->built_statement="SELECT $this->fields FROM $this->module WHERE $this->where $regex_phrase $group_phrase ORDER BY $this->order $this->limit";

        // if(Connection::$conn[$this->connection_index] instanceof PDO){
            // try{
            //     $prepared_statement=$conn->prepare($this->built_statement);
            //     $result=$prepared_statement->execute($this->params);
            //     if($this->mark)m($this->built_statement);
            //     if($result==false)throw new PDOException();
            //     $res_data=$prepared_statement->fetchAll(PDO::FETCH_ASSOC);
            //     $this->count=$prepared_statement->rowCount();
            //     if($this->count<=0)return;
            //     $this->data=$res_data;
            // }
            // catch(PDOException $e){
            //     // if($_legion->bot){
            //     //     global $_url;
            //     //     Debug::m('Legion-Sitemap caused the following issue, by hitting this URL: '.$_url->current_link);
            //     // }
            //     /**
            //      * @todo mark 5 args?
            //      */
            //     m($this->built_statement,
            //         '<div class="l_purple_c">MySQL Statement: </div>',
            //         '<div class="l_mb3"></div>'.$e->getMessage(),
            //         // '<div class="l_lava_c">MySQL Error: </div>',
            //         // '<div class="l_mb3"></div>'
            //     );
            //     return;
            // }
        // }elseif(Connection::$conn[$this->connection_index] instanceof MySQLi){
            try{
                $prepared_statement=$conn->prepare($this->built_statement);
                $result=self::execute_statement($prepared_statement,$this->params);
                
                if($this->mark)m($this->built_statement);
                if($result==false)throw new Exception(mysqli_error($conn));
                $res_data=$prepared_statement->get_result();
               
                $this->count=$res_data->num_rows;
                if($this->count<=0)return;

                while($row=$res_data->fetch_assoc()){
                    $this->data[]=$row;
                }
            }
            catch(Exception $e){
                // if($_legion->bot){
                //     global $_url;
                //     m('Legion-Sitemap caused the following issue, by hitting this URL: '.$_url->current_link);
                // }
                // m('omar');
                // die();
                // die('omar');
                m($this->built_statement,
                    '<div class="l_purple_c">MySQL Statement: </div>',
                    '<div class="l_mb3"></div>'.$e->getMessage()
                );
                return;
            }
        // }
    }

    
    /**
     * (d)ata (b)ase (s)tatement execution
     * upon failure, it will mark in error log
     * @param  string $statment
     * @return false|array
     */
    public static function dbs($statment,$params=[],$connection_index=0){
        global $conn;
        // if(Connection::$conn[$connection_index] instanceof PDO){
        //     try{
        //         $prepared_statement=Connection::$conn[$connection_index]->prepare($statment);
        //         $result=$prepared_statement->execute($params);
        //         if($result==false)throw new PDOException();
        //         if($prepared_statement->rowCount()>0){
        //             $resp=$prepared_statement->fetchAll(PDO::FETCH_ASSOC);
        //             if(!empty($resp))return $resp;
        //         }
        //         return true;
        //     }catch(PDOException $e){
        //         Debug::m($statment,'<div class="l_purple_c">MySQL Statement: </div>','<div class="l_mb3"></div>');
        //         Debug::m($e->getMessage(),'<div class="l_lava_c">MySQL Error: </div>','<div class="l_mb3"></div>');
        //         return false;
        //     }

        // }elseif(Connection::$conn[$connection_index] instanceof MySQLi){
            try{
                $prepared_statement=$conn->prepare($statment);
                $result=self::execute_statement($prepared_statement,$params);
                if($result==false)throw new Exception(mysqli_error($conn));
        
                $res_data=$prepared_statement->get_result();
                if(isset($res_data->num_rows) && $res_data->num_rows>0){
                    $resp=[];
                    while($row=$res_data->fetch_assoc()){$resp[]=$row;}
                    return $resp;
                }
                return true;
            }catch(Exception $e){
                m($statment,'<div class="l_purple_c">MySQL Statement: </div>','<div class="l_mb3"></div>');
                m($e->getMessage(),'<div class="l_lava_c">MySQL Error: </div>','<div class="l_mb3"></div>');
                return false;
            }
        // }
        // return false;
    }



    public static function last_id($connection_index=0){
        global $conn;
        // if(Connection::$conn[$connection_index] instanceof PDO){
        //     return Connection::$conn[$connection_index]->lastInsertId();
        // }elseif(Connection::$conn[$connection_index] instanceof MySQLi){
            return mysqli_insert_id($conn);
        // }
    }
    
    /**
     * other_langs of the db object already in hand
     *
     * @param  db $db_obj
     * @return db
     */
    public static function other_langs($db_obj){
        $others=clone $db_obj;
        $others->limit=NULL;
        if($others->lang==NULL){
            $others->count=0;
        }else{
            $others->match=false;
            $others->process();
        }
        return $others;
    }

    
     /**
     * (o)ne entry only
     * @todo escape?
     * @param  string $module
     * @param  string|int $value
     * @param  string $key FROM SYSTEM, not from USER
     * @return array
     * @return null
     */
    public static function o($module,$value,$key='id',$fields='*'): array|null{
        /**
         * @todo is user allowed to access this module?column?
         */
        $db=new db($module);
        // $db->where=escape($key)."='".Security::escape($value)."'";
        $db->where=$key.'=?';
        $db->params=[$value];
        $db->fields=$fields;
        $db->limit='LIMIT 1';
        $db->process();

        if($db->count==1){
           return $db->data[0];
        }
        return NULL;
    }

    public static function column($module,$key,$value,$field): string|null{
        /**
         * @todo is user allowed to access this module?column?
         */
        $db=new db($module);
        // $db->where=escape($key)."='".Security::escape($value)."'";
        $db->where=$key.'=?';
        $db->params=[$value];
        $db->fields=$field;
        $db->limit='LIMIT 1';
        $db->process();

        if($db->count==1 && isset($db->data[0][$field])){
           return $db->data[0][$field];
        }
        return NULL;
    }

    public static function sum($tableName,$col=NULL,$where=NULL,$params=[]):int|float{
        $result=db::dbs("SELECT SUM($col) FROM $tableName $where",$params);
        if($result[0]["SUM($col)"]==NULL)return 0;
        return $result[0]["SUM($col)"];
    }

    public static function countEntries($tableName,$where=NULL,$params=[]): int{
        $result=db::dbs("SELECT COUNT(1) FROM $tableName $where",$params);
        if($result===false)return 0;
        return (int)$result[0]["COUNT(1)"];
    }

}

// /**
//  * Shortcuts for (d)ata(b)ase (q)uick
//  * 
//  */
// class dbq extends DB{
//     /**
//      * (c)ontrol
//      * if index sent NULL, it'll reutrn the whole data[0]
//      * @param  string $code
//      * @param  string $index
//      * @return first_row|NULL
//      */
   
//      public static function c($code,$index=NULL){
//         $db=new db('control_1566842582');
//         $db->where="code=?";
//         $db->params=[$code];
//         $db->limit='LIMIT 1';
//         if($index!=NULL)
//             $db->fields=$index;
//         $db->process();

//         if($db->count==1){
//             if($index==NULL)
//                 return $db->data[0];
//            return $db->data[0][$index];
//         }
//         return NULL;
//     }

   
//     /**
//      * connection
//      * @param  string $field
//      * @return field_value|NULL
//      */
//     public static function connection($field){
//         $db=new db('connections_1565698558');
//         $db->where="id=1";
//         $db->limit='LIMIT 1';
//         $db->process();

//         if($db->count==1){
//            return $db->data[0][$field];
//         }
//         return NULL;
//     }
    
//     /**
//      * (com)plementary
//      *
//      * @param  string $mother_module
//      * @param  string|int $mother_id
//      * @param  string $child_module
//      * @param  string|int $child_id
//      * @return db
//      */
//     public static function com($mother_module=NULL,$mother_id=NULL,$child_module=NULL,$child_id=NULL,$deleted=false){
//         $where=$deleted?'deleted AND':'!deleted';

//         if($mother_module!=NULL){
//             $where.=' AND mother_module=?';
//             $params[]=Module::id($mother_module);
//         }

//         if($mother_id!=NULL){
//             $where.=' AND mother_id=?';
//             $params[]=$mother_id;
//         }

//         if($child_module!=NULL){
//             $where.=' AND child_module_prefix=?';
//             $params[]=Module::id($child_module);
//         }

//         if($child_id!=NULL){
//             $where.=' AND child_id=?';
//             $params[]=$child_id;
//         }

//         $db=new DB('complementary_1614118171');
//         $db->where=$where;
//         $db->params=$params;
//         $db->process();
//         return $db;
//     }

//     public static function error($id): array|null{
//         $db=new DB('error_1528374155');
//         $db->where='id=?';
//         $db->params=[$id];
//         $db->limit='LIMIT 1';
//         $db->process();
//         if($db->count){
//             return $db->data[0];
//         }
//         return NULL;
//     }
// }