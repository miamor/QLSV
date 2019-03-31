<?php 
include 'include/config.xml.php'; 
//include_once 'include/xmldb.php';

$conn = xmlDb::connect('QLSV');
//xmlDb::chmodDatabase('database', 0755);
//xmlDb::chmod('QLSV', 0777);

/*
// add table
$conn->addTable('lop');
$conn->addTable('dantoc');
$conn->addTable('sinhvien');
$conn->addTable('user');
$conn->addTable('admin');


// get tables names
$tables = $conn->getTables();
// print table names
print_r($tables);


// add column "id" and set its value to 1
$conn->in('lop')->addColumn('id', 1);
$conn->in('lop')->addColumn('name', 'CNTT');

$conn->in('dantoc')->addColumn('id', 1);
$conn->in('dantoc')->addColumn('name', 'Kinh');

$conn->in('sinhvien')->addColumn('id', 1);
$conn->in('sinhvien')->addColumn('username', 'abc');
$conn->in('sinhvien')->addColumn('password', 'abc');
$conn->in('sinhvien')->addColumn('name', 'Abc Def');
$conn->in('sinhvien')->addColumn('phone', '0987654321');
$conn->in('sinhvien')->addColumn('birthday', '1997-03-05');
$conn->in('sinhvien')->addColumn('class', 1);
$conn->in('sinhvien')->addColumn('ethnic', 1);
$conn->in('sinhvien')->addColumn('timelife', '');
$conn->in('sinhvien')->addColumn('status', 0);

$conn->in('admin')->addColumn('id', 1);
$conn->in('admin')->addColumn('username', 'admin');
$conn->in('admin')->addColumn('password', md5('admin'));

// insert
$conn->in('lop')->insert([
	//'id'     => 2,
	'name' => 'BĐATTT'
]);

/*
// delete all rows where column "name" equal to "John" 
$conn->from('example_table')->where('name', 'John')->delete();
   
// limiting delete
// delete 5 records where id > 1
$conn->from('example_table')->where('id', 1, '>')->limit(5)->delete();
// delete where id = 1
$conn->from('example_table')->where('id', 1, '=')->limit(1)->delete();
*/
$conn->from('lop')->select('*');
// get one row
$rows = $conn->getAll();
var_dump($rows);

/*
// Get data
$conn->from('sinhvien')->select('id, name, class');

// get one row
$row = $conn->getRow();
var_dump($row);
echo '<hr/>';
// get all rows
$rows = $conn->getAll();
// print data
foreach ($rows as $row) {
    var_dump($row);
    echo '<br/>';
}
*/


