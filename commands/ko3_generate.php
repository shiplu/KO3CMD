<?php
// generator
class ko3_generate extends ko3_command{
	public function ormmodel($name, $tblname, $pk = 'id'){
		$name = strtolower($name);
		$name = ucfirst($name);
		$text = "<?php
/**
 * $name model
 */
class Model_$name extends ORM{
    protected \$_belongs_to = array();
    protected \$_has_many = array();
    protected \$_has_one = array();
    protected \$_primary_key = '$pk';
    protected \$_table_name = '$tblname';
}
";
		$fname = "application/classes/model/".strtolower($name).".php";
		file_put_contents($fname, $text);
		LOG::info("Model $name created on $fname");
	}
}

