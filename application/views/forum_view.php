<style>
	.subject {
		border: 1px solid black;
		border-radius: 4px;
		padding: 8px;
		margin-bottom: 10px;
	}	

	.subject a {
		text-decoration: none;
	}
	
	.pagination a {
		text-decoration: none;
		font-size: 20px;
		margin-right: 5px;
		margin-bottom: 10px;
	}
	
	.active {
		color: red;
	}
</style>
<h1>ФОРУМ</h1>
<?php
	if ($_SESSION['active'] == 1 && $_SESSION['id_role'] != 3) {
		echo "<button onClick=location.href='/forum/new'>Новая тема</button>";
	}
?>
<div class = 'container'>
<pre>
<?php 
	//var_dump ($data);
	//var_dump ($_SESSION);
?>
</pre>
	<?php
	echo "<div class = 'pagination'>";
	for ($i = 1; $i <= $data[0]; $i++)
        {
            if ($i != $data[1]) {
                echo "<a href='/forum/page/$i'>$i</a>";
            }
            else {
                echo "<a href='/forum/page/$i' class='active'>$i</a>";
            }
        }
        echo '</div>';
	foreach ($data['subjects'] as $subject) {
		echo "
				<div class = 'row subject'>
					<div class = 'col-sm'>Название: " . $subject['title'] . "</div>
					<div class = 'col-sm'>Автор: " . $subject['login'] . "</div>
					<div class = 'col-sm'>Дата создания: " . $subject['date'] . "</div>
					<div class = 'col-sm'>Разрешение: "; 
												if ($_SESSION['id_role'] == '1') echo "ДА";
												else {
													if (isset($data['permissions'])) { 
														foreach ($data['permissions'] as $perms) {
															if (!in_array($subject['id'], $perms)) {
																$find = 0;
															}
															else {
																$find = 1;
																break;
															}	
														}
														if ($find == 0) echo "НЕТ";
														if ($find == 1) echo "ДА";
													}
													else echo "НЕТ";
												}
			echo "</div><div class = 'col-sm'><a href='/forum/subject/". $subject['id'] ."' >Перейти в тему</a></div></div>";
	}
	echo "<div class = 'pagination'>";
	for ($i = 1; $i <= $data[0]; $i++)
        {
            if ($i != $data[1]) {
                echo "<a href='/forum/page/$i'>$i</a>";
            }
            else {
                echo "<a href='/forum/page/$i' class='active'>$i</a>";
            }
        }
        echo '</div>';
	?>
</div>