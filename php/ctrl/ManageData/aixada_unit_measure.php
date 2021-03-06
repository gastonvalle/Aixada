<?php
require_once(__ROOT__."php/lib/abstract_data_manager.php");

class data_manager extends abstract_data_manager {
    public function db_table(){
        return 'aixada_unit_measure';
    }
    public function title(){
        global $Text;
        return $Text['nav_mng_units'];
    }
    protected function before_delete($values) {
        global $Text;
        return $this->chk_related($values, $Text['nav_mng_products'],
            "select id from aixada_product where
                unit_measure_order_id = {id} or
                unit_measure_shop_id = {id}");
    }
    protected function form_fields(){
        global $Text;
        return "[{
                name:'id',
                width:'50',
                editable:false
            }, {
                name:'name', label:'".$Text['name']."',
                width:'250',
                editrules:{required:true}
            }, {
                name:'unit', label:'".$Text['unit']."',
                width:'700',
                editrules:{required:true}
        }]";
    }
}
?>
