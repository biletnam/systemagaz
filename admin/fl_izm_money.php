<?php
session_start();

include_once "classes/App.php"; // подключаем функции приложения
$pdo = new Database();

// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("vhod.php");
}  
// Иначе открываем для него контент
else { include("verh.php"); ?>

  <!-- / nav -->
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
      <div class="row">
<?php
$id = $_GET['id'];
$params = $pdo->getRow("SELECT * FROM `money` WHERE `id`= ? ",[$id]);
?>
<section class="panel">
            <div class="panel-body">
              <form action="classes/App.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование валюты</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Валюта:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="name" placeholder="" class="form-control parsley-validated" value="<?php echo $params['name']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="action" value="izm_money">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Цена:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="chena" placeholder="" class="form-control parsley-validated" value="<?php echo $params['chena']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Примечание:</label>
                  <div class="col-lg-8">
                    <textarea placeholder="Содержание" rows="3" name="komment" class="form-control parsley-validated" data-trigger="keyup" ><?php echo $params['komment']; ?></textarea>
                  </div>
                </div>

                 
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="money.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>

<?php include("niz.php"); }?>