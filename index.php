<?php  include('server.php'); 


echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
<nav style=" 
display:flex">
<a style="border: 1px solid #bbbbbb;
border-radius: 5px;
padding:10px;
text-decoration:none;
background:green;
color:white" href="#">Categories</a>
<a style="border: 1px solid #bbbbbb;
border-radius: 5px;
padding:10px;
text-decoration:none;" href="products.php">products</a>
</nav>';

    $results = mysqli_query($db, "select * from cate");
   echo'<table>
	<thead>
		<tr>
			<th>Category Name</th>
			<th>Book ID</th>
			<th colspan="2">Book Details</th>
            <td>
				<a href="addcate.php" style="
                text-decoration: none;
                padding: 2px 5px; 
                border-radius: 3px;
                color:black;
                background: #eee;">Add</a>
			</td>
		</tr>
	</thead>';
	
 while ($row = mysqli_fetch_array($results)) {
   
		echo '<tr>
			<td>'.$row["name"].'</td>
			<td>'.$row["bookid"].'</td>
			<td>'.$row["details"].'</td>
			<td>
				<a href="index.php?edit='.$row["id"].'" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="index.php?del='.$row["id"].'" class="del_btn">Delete</a>
			</td>
            
		</tr>';
    }
echo '
</table>
';
class Categories{
public $update;
public $id;
public $name;
public $details;
public $bookid;
public $db; 
public $record;

function getUpdate(){return $this->update;}
function getId(){return $this->id;}
function setId($id){$this->id = $id;}
function setDb(){$this->db = mysqli_connect('localhost', 'root', '', 'dashboard');}
function setRecord(){$this->record =mysqli_query($this->setDb(), "select * from cate where id=".$this->id);}
function getName(){return $this->name;}
function getDet(){return $this->details;}
function getBid(){return $this->bookid;}

 function getEditBtn(){
	if (isset($_GET['edit'])) {
		$this->setDb();
		$this->setId($_GET['edit']);
		$this->setRecord();
		$this->$n = mysqli_fetch_array($record);
		$this->$name = $n['name'];
		$this->$bookid = $n['bookid'];
		$this->$details = $n['details'];
	  
	}
 }
}

$cate = new Categories();
$cate -> getEditBtn();

echo'
<form method="post" action="index.php" >
		<div class="input-group">
			<label>Update Category</label>
			<input type="hidden" name="id" value="'.$cate->getId().'">
		</div>
		<div class="input-group">
			<label>Category Name</label>
			<input type="text" name="name" value="'.$cate->getName().'">
		</div>
        <div class="input-group">
			<label>Book ID</label>
			<input type="text" name="Bid" value="'.$cate->getBid().'">
		</div>
        <div class="input-group">
			<label>Details</label>
			<input type="text" name="details" value="'.$cate->getDet().'">
		</div>
		<div class="input-group">';

        if($cate->getUpdate() == true)
           { echo'<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>';}
            else{echo'<button class="btn" type="submit" name="save" >Save</button>';}
		echo'</div>
	</form>';

echo '</body></html>';
?>