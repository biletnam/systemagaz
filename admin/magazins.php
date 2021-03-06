<?php
session_start();

//include_once "classes/Database.php"; // подключаем БД
include_once "classes/App.php"; // подключаем функции приложения
$pdo = new Database();

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
        <br><br>
<div class="row">
        <div class="col-lg-12">

<section class="panel">
<br><b><span class="center">
            <?php
            // если название магазина отсутствует, тогда выводим кнопку создать магазин
            $sql_get_magazins = $pdo->getRows( "SELECT * FROM `magazins` ORDER BY `name` DESC ");
            foreach ( $sql_get_magazins as $data_magaz ) { }
            if ( empty($data_magaz) ) { ?>
                |<a class="btn btn-sm btn-info" data-toggle="modal" href="#modal"><i class="icon-shopping-cart"></i> Новый магазин</a> |
            <?php } ?>
        </span></b><br><br>
    <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Название магазина</b></th>
                    <th><b>Номер телефона</b></th>
                    <th><b>Email</b></th>
                    <th><b>Примечание</b></th>
                    <th><b>Показ группы в OK</b></th>
                    <th><b>ID группы в OK</b></th>
                    <th><b>Instagram логин</b></th>
                    <th><b>Instagram пароль</b></th>
                    <th><b>Действие</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');

// Если роль пользователя 3
if ($user_role=='3') {
    $sql_get_device = $pdo->getRows( "SELECT * FROM `magazins` ORDER BY `name` DESC ");
    foreach ( $sql_get_device as $data_get_device ) { ?>
                  <tr>
                    <td><?php echo $data_get_device['name']; // название магаза ?></td>
                    <td><?php echo $data_get_device['phone']; ?></td>
                    <td><?php echo $data_get_device['email']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                    <td><?php echo $data_get_device['reklama']; ?></td>
                      <td><?php echo $data_get_device['id_ok_group']; ?></td>
                      <td><?php echo $data_get_device['instagram_login']; ?></td>
                      <td><?php echo $data_get_device['instagram_password']; ?></td>
                    <td><a data-toggle="modal" href="#delete<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_magaz.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

                    <div id="modal" data-backdrop="false" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="classes/App.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый магазин</h4>
                    </div>
                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                        <input type="hidden" name="action" value="add_magaz">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Примечание:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
                    </div>
                    

                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Внести в справочник</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>

            <?php
            $sql_get_device = $pdo->getRows( "SELECT * FROM `magazins` ORDER BY `name` DESC ");
            foreach ( $sql_get_device as $data_get_device ) { ?>
                <!--Модальное окно удаления товара-->
                <div id="delete<?php echo $data_get_device['id']; ?>" data-backdrop="false" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" enctype = "multipart/form-data" action="classes/App.php?action=del_magaz&id=<?php echo $data_get_device['id']; ?>"  method="POST">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Вы хотите удалить магазин?</h4>
                                </div>

                                <center>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Да</button>
                                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Нет!</button>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

