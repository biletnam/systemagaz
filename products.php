<?php
session_start();
// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("vhod.php");
}  
// Иначе открываем для него контент
else { include("verh.php"); ?>

<!-- / Тело страницы -->
  <section id="content">
    <section class="main padder">
      <div class="row">
        <div class="col-lg-12">
          <section class="toolbar clearfix m-t-large m-b">
          </section>
        </div>
</div>
        </div>
      </div>

                    <br>
                    <br>



<div class="row">
        <div class="col-lg-12">

<section class="panel">
<br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#categor"><i class="icon-folder-open-alt"></i> Новая категория</a> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#tovar"><i class="icon-shopping-cart"></i> Новый товар</a> |</span></b><br><br>
            <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Категория</b></th>
                    <th><b>Дейстиве</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
                        $sql_get_device = mysql_query("SELECT * FROM `categor` ORDER BY `name` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td><a href="fl_open_products.php?id_categor=<?php echo $data_get_device['id']; ?>"><?php echo $data_get_device['name']; ?></a></td>
                    <td><a href="fl_del_categor.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_categor.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {
                        $sql_get_device = mysql_query("SELECT * FROM `categor` ORDER BY `name` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td><a href="fl_open_products.php?id_categor=<?php echo $data_get_device['id']; ?>"><?php echo $data_get_device['name']; ?></a></td>
                    <td><a href="fl_del_categor.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_categor.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

                    <div id="categor" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="fl_post_add_categor.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новая категория</h4>
                    </div>
                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                    </div>
                    </div>


                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>





                    <div id="tovar" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="fl_post_add_tovar.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый товар</h4>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Категория:</label>
                    <select name="categor_id">
                    <?php
                    $sql_get_categor = mysql_query("SELECT * FROM `categor` ",$db);
                      while ($data_categor = mysql_fetch_assoc($sql_get_categor)) {
                      echo "<option value=".$data_categor['id'].">".$data_categor['name']."</option>";
                    }
                    ?>
                    </select>
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Модель:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="model" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цена(вх.):</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_input" autofocus autocomplete="off">
                    <select name="money_input">
                    <?php
                    $sql_get_money = mysql_query("SELECT * FROM `money` ",$db);
                      while ($data_money = mysql_fetch_assoc($sql_get_money)) {
                      echo "<option>".$data_money['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цена(вых.):</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_output" autofocus autocomplete="off">
                    <select name="money_output">
                    <?php
                    $sql_get_money = mysql_query("SELECT * FROM `money` ",$db);
                      while ($data_money = mysql_fetch_assoc($sql_get_money)) {
                      echo "<option>".$data_money['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Комментарий:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">

                    <div class="block">
                    <label class="control-label">Статус:</label><br>
                      <select name="status">
                            <option selected value="Доступен">Доступен</option>
                            <option value="Недоступен">Недоступен</option>
                            <option value="Неизвестен">Неизвестен</option>
                      </select>
                    </div>


                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

