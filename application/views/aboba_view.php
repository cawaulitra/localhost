<style>
    th, tr, td, table {
        border: 1px solid black;
        padding: 10px;
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
<table>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>FIO</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
<?php
    if (isset($_SESSION['success'])) {
        if ($_SESSION['success'] == TRUE) {
            echo "Пользователь удалён!";
            unset($_SESSION['success']);
        }

        else {
            echo "Что-то пошло не так.";
            unset($_SESSION['success']);
        }
    }

    foreach ($data['users'] as $user) {
        echo "  <tr>
                <td>".$user['id']."</td>
                <td>".$user['login']."</td>
                <td>".$user['fio']."</td>
                <td>".$user['id_role']."</td>
                <td>
                    <a href='/user/edit/".$user['id']."' style='color: green;'>Edit</a>
                    <a href='/user/delete/".$user['id']."' style='color: red;'>Delete</a>
                </td>
                </tr>
            ";
    }
?>
</table>
<?php
echo "<div class = 'pagination'>";
	for ($i = 1; $i <= $data[0]; $i++)
        {
            if ($i != $data[1]) {
                echo "<a href='/user/aboba/$i'>$i</a>";
            }
            else {
                echo "<a href='/user/aboba/$i' class='active'>$i</a>";
            }
        }
        echo '</div>';
?>