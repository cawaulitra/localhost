<script type = "text/javascript">
			function ajaxuser()	{
                    var text = document.getElementById('searcher').value;
                    if (text.length > 2) 					
                    {
						console.log("hello world");
                        var arr = new Array();
                        var select = document.querySelectorAll('input.check_item');
                        select.forEach(function(item) {
                            arr.push(item.value);
                        })
                        $.ajax({
							type: 'POST',
							url: '/forum/ajaxUsers',
							data: { login:text, ids:arr },
							async: true,
							cache : false,
							success: function(data) {
								$(".result").html(data);
							}	
						});
                    }
                    else
                    {
                        $(".result").empty();
                    }
                }

            function addcheck(id, login) {
                var str_input = "<input class='check_item' onclick='delcheck(" + id + ")' onclick='delcheck(id)' type='checkbox' checked='checked' name='perm[]' id='p" + id + "'value='" + id + "'><label for = 'p" + id + "' id='pl"+ id +"'>"+ login +"</label></input><br id='plb"+ id +"'>";
                $('.permissions').append(str_input);
                $('.result').html('');
            }

            function delcheck(id) {
                $('#p' + id +'').remove();
                $('#pl' + id + '').remove();
                $('#plb' + id + '').remove();
            }
        </script>
<h1>НОВАЯ ТЕМА</h1>
<h2>
<?php 
	echo $data;
?>
</h2>
<form action = "/forum/createSubject" method="post">
	<p><input type="text" name="title" id="title" placeholder="Название темы"></input></p>
	<p>Пользователи:</p>
	<div class="permissions">

	</div>
	<div class="search">
		<input type="text" autocomplete="off" placeholder="Поиск пользователей" id="searcher" onkeyup="ajaxuser()">
		<div class="result" id="result"></div>
	</div></br>
	<button type="submit" name="sub">Отправить</button>
</form>