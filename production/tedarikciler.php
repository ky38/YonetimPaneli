<?php include 'header.php'; 
include '../netting/baglan.php';

if (isset($_POST['arama'])) 
{
  $aranan=$_POST['aranan'];
  $tedarikcisor=$db->prepare("SELECT*from tedarikciler  where tedarikci_ad like '%$aranan%'  order by tedarikci_sira asc limit 25 ");
  $tedarikcisor->execute();
  $say=$tedarikcisor->rowCount();
}
else
{
  $tedarikcisor=$db->prepare("SELECT*from tedarikciler  order by tedarikci_sira asc limit 25");
  $tedarikcisor->execute();
  $say=$tedarikcisor->rowCount();
}
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tedarikci Paneli</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                  
                  <form action="" method="POST">
                  <div class="input-group">
                    
                    <input type="text" class="form-control" name="aranan" placeholder="Anahtar Kelimeyi Giriniz...">
                    
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit" name="arama">Ara!</button>
                    </span>
                  </div>
                  </form>

                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div align="left" class="col-md-6">
                    <h2>Tedarikci İslemleri <br><small style="color: purple;"><?php echo $say." Kayıt"; echo " Getirildi..."; ?></small>
                      <small>
                        <?php
                        

                    if ($_GET['durum']=="ok") { ?>


                    <p style="color:green;" class="page-subhead-line">İşlem Başarılı... </p>


                    <?php } elseif ($_GET['durum']=="no") { ?>


                    <p style="color:red;" class="page-subhead-line">İşlem Başarısız... </p>


                    <?php  } else {?>

                    <p class="page-subhead-line"></p>

                    <?php   }

                    ?>
                      </small>
                    </h2>

                     
                    </div>
                    <div class="col-md-6" align="right">
                     <a href="tedarikci-ekle.php"><button class="btn btn-success btn-xs"><i class="fa fa-book" aria-hidden="true"></i>Yeni Ekle</button></a> 
                    </div>
                    
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                            <th class="text-center">tedarikci Resim</th>
                            
                            <th class="text-center">tedarikci Ad</th>
                            <th class="text-center">tedarikci Sıra </th>
                            

                            <th width="80" class="text-center"></th>
                            <th width="80" class="text-center"></th>
                            
                            </th>
                            
                          </tr>
                        </thead>

                        <tbody>

                          <?php 


                            while ($tedarikcicek=$tedarikcisor->fetch(PDO::FETCH_ASSOC)) 
                              { ?>
                                
                                <tr class="odd pointer">
                                  <td class="text-center"><img style="width: 150px; height: 100px;" src="../../<?php echo $tedarikcicek['tedarikci_resim']; ?>"> </td>
                                  
                                  <td class="text-center"><?php echo $tedarikcicek['tedarikci_ad']; ?></td>
                                  <td class="text-center"><?php echo $tedarikcicek['tedarikci_sira']; ?></td>
                                  
                                  <td class="text-center"><a href="tedarikci-duzenle.php?tedarikci_id=<?php echo $tedarikcicek['tedarikci_id']; ?>"><button style="width: 80px;" class="btn btn-primary btn-xs"><i class="fa fa-pencil" ariahidden="true"></i>Düzenle</button></a></td>
                                  <td class="text-center"><a href="../netting/islem.php?tedarikci_id=<?php echo $tedarikcicek['tedarikci_id']; ?>&tedarikcisil=ok&tedarikciresimsil=<?php echo $tedarikcicek['tedarikci_resimyol']; ?>"><button style="width: 80px;" class="btn btn-danger btn-xs"><i class="fa fa-trash" ariahidden="true"></i>Sil</button></a></td>
                                </tr>
                           <?php }
                           ?>
                          
                          
                          
                        </tbody>
                      </table>
                    </div>
                    
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>