<?php
session_start();
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
$get_params = mysql_query("SELECT * FROM `status` WHERE `id`='$id' ",$db); //извлекаем из базы все данные о пользователе с введенным логином
$params = mysql_fetch_array($get_params);
?>
<section class="panel">
            <div class="panel-body">
              <form action="fl_post_izm_status.php" class="form-horizontal" method="POST" data-validate="parsley">      
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование статуса заказа</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Название:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="name" placeholder="" class="form-control parsley-validated" value="<?php echo $params['name']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Примечание:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="komment" placeholder="" class="form-control parsley-validated" value="<?php echo $params['komment']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Цвет:</label>
                  <div class="col-lg-8">
                    <select name="color">
                        <option selected value="<?php echo $params['color']; ?>"><?php echo $params['name_color']; ?></option>
                        <option value="#FFFFFF">Без цвета</option>
                        <option value="#45B5B3">Cиний</option>
                        <option value="#45B562">Зеленый</option>
                        <option value="#E7D627">Желтый</option>
                        <option value="#CC3E43">Красный</option>
                        <option value="#CCC9CF">Серый</option>
                      </select>
                  </div>
                </div>
                 
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="status.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>

<?php include("niz.php"); }?>