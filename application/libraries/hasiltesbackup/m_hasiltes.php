<!--
<div class="modal fade" id="modal-pertanyaan" role="dialog">
  <div class="modal-dialog"  style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Penilaian HR</h4>
      </div>
      <div class="modal-body">
        <div class="box-body pad">
          <table id="example1" class="table table-bordered table-striped">
            <tbody>
              <form id="form-pertanyaan">
                <?php foreach ($pertanyaan as $p) { ?>
                <tr>
                  <th id="pertanyaan"><?php echo $p->pertanyaan ?></th>
                  <input type="hidden" name="ref_pertanyaan[]" value="<?php echo $p->kode ?>">
                  <td><input type="text" name="ref_hasil[]"></td>
                  <td><input type="text" class="form-control" placeholder="" name="jawaban[]" ></td>
                </tr>
                <?php }  ?>
              </form>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        <button type="button" id="btnSave" onclick="savehasildetail()" class="btn btn-primary">Muat Pertanyaan</button>
      </div>
    </div>
  </div>
</div>
 Modal
<div class="modal fade" id="modal-pertanyaan-user" role="dialog">
  <div class="modal-dialog"  style="width: 80%;">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Penilaian User</h4>
      </div>
      <div class="modal-body">
        <div class="box-body pad">
          <table id="example1" class="table table-bordered table-striped">
            <tbody>
              <form id="form-pertanyaan-user">
                <?php foreach ($pertanyaanuser as $p) { ?>
                <tr>
                  <th id="pertanyaan"><?php echo $p->pertanyaan ?></th>
                  <input type="hidden" name="ref_pertanyaanuser[]" value="<?php echo $p->kode ?>">
                  <td><input type="text" name="ref_hasiluser[]"></td>
                  <td><input type="text" class="form-control" placeholder="" name="jawabanuser[]" ></td>
                </tr>
                <?php }  ?>
              </form>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        <button type="button" id="btnSave" onclick="savehasildetailuser()" class="btn btn-primary">Muat Pertanyaan</button>
      </div>
    </div>
  </div>
</div>
END MODAL INPUT-->
<!-- MODAL INPUT-->
<!-- Modal -->
<div class="modal fade" id="modal-lulus" role="dialog" data-backdrop="static">
  <div class="modal-dialog" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Penilaian <span id="toggle-hr">HR</span></h4>
      </div>
      <div class="modal-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Tes</a></li>
            <li><a href="#tab_2" data-toggle="tab">Interview</a></li>
            <li><a href="#tab_3" data-toggle="tab">Komentar</a></li>
            <li><a href="#tab_4" data-toggle="tab">Koresponden</a></li>
            <li id="tab-ask-hr"><a href="#tab_5" data-toggle="tab">Pertanyaan</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="box-body pad">
                <form id="form-lulus">
                  <input type="hidden" class="form-control" placeholder="ID" id="id" name="id" style="width: 15%;" value="" readonly="true">
                  <div class="form-group">
                    <label>Nilai Tes</label>
                    <input type="number" id="teshr" name="teshr" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Diterima / Tidak Diterima</label>
                    <select class="form-control select2"  name="lulus" id="lulus">
                      <option value="">--</option>
                      <option value="t">Diterima</option>
                      <option value="f">Tidak Diterima</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Rekomendasi HR</label>
                    <select class="form-control" style="width: 100%; border-radius: 0px" name="rekomendasihr" id="rekomendasihr">
                      <option name="p" value="">--</option>
                      <?php foreach ($lowongan as $p) {
                      ?>
                      <option value="<?php echo $p->kode ?>"><?php echo $p->posisi ?></option>
                      <?php }  ?>
                    </select>
                  </div>
                </form>
                </div><!--Box Body-->
                <div class="box-footer pad">
                  <button type="button" id="save_hr" class="btn btn-primary">Simpan</button>
                </div>
                </div><!-- Tab 1 -->
                <div class="tab-pane" id="tab_2">
                  <div class="box-body pad">
                    <input type="hidden" name="id-for-getkode">
                    <form id="form-ubah-jawaban">
                      
                    </form>
                    <div class="table-responsive mailbox-messages">
                      <table id="tablehr" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th width="1%">No.</th>
                            <th>Pertanyaan</th>
                            <th style="display: none;">Mirror Pertanyaan</th>
                            <th>Jawaban</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                    </div><!--Box Body-->
                    <div class="box-footer pad">
                      <button type="button" id="btn-delete-penilaian" class="btn btn-danger pull-left">Hapus Pertanyaan</button>
                      <button type="button" id="btn-ubah-penilaian" class="btn btn-primary pull-right">Simpan</button>
                      <button type="button" id="btnSavehr" onclick="savehasildetail()" class="btn btn-success pull-right">Muat Pertanyaan</button>
                    </div>
                    </div><!-- Tab 2-->
                    <div class="tab-pane" id="tab_3">
                      <div class="box-body pad">
                        
                        <form id="form-komentar-hr">
                          <input type="hidden" name="id-for-getkode">
                          <div class="form-group">
                            <label>Komentar :</label>
                            <textarea class="form-control" rows="10" name="komentarhr" id="komentarhr"></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="box-footer">
                        <button type="button" id="save_komentar_hr" class="btn btn-primary">Simpan</button>
                      </div>
                      </div><!-- Tab 3-->
                      <div class="tab-pane" id="tab_4">
                        <div class="box-body pad">
                          
                          <form id="form-koresponden">
                            <input type="hidden" name="id-for-getkode">
                            <div class="form-group">
                              <label>Koresponden :</label>
                              <textarea class="form-control" rows="20" name="koresponden" id="koresponden"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="box-footer pad">
                          <button type="button" id="save_koresponden" class="btn btn-primary">Simpan</button>
                        </div>
                        </div><!-- Tab 4 -->
                        <div class="tab-pane" id="tab_5">
                          <div class="box-body pad">
                          <form id="form-ask-hr"></form>
                          <table id="tableaskhr" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <th>ref hasil</th>
                              <th style="display: ;">ref pertanyaan</th>
                              <th style="display: ;">Pertanyaan</th>
                            </thead>
                            <tbody>
                              
                            </tbody>
                          </table>
                        </div>
                        </div><!-- Tab 5 -->
                        </div><!-- Tab Content -->
                        </div><!-- Navtab Custom -->
                        </div><!-- modal body -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END MODAL INPUT-->
                  <!-- Modal -->
                  <div class="modal fade" id="modal-lulus-user" role="dialog" data-backdrop="static">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Penilaian <span id="toggle-user">User</span></h4>
                        </div>
                        <div class="modal-body">
                          <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1user" data-toggle="tab">Tes</a></li>
                              <li><a href="#tab_2user" data-toggle="tab">Interview</a></li>
                              <li><a href="#tab_3user" data-toggle="tab">Komentar</a></li>
                              <li id="tab-ask-user"><a href="#tab_4user" data-toggle="tab">Pertanyaan</a></li>

                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1user">
                                <div class="box-body pad">
                                  <form id="form-lulus-user">
                                    <input type="hidden" class="form-control" placeholder="ID" id="iduser" name="id" style="width: 15%;" value="" readonly="true">
                                    <div class="form-group">
                                      <label>Nilai Tes</label>
                                      <input type="number" id="tesuser" name="tesuser" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>Diterima / Tidak Diterima</label>
                                      <select class="form-control select2"  name="lulususer" id="lulususer">
                                        <option value="">--</option>
                                        <option value="t">Diterima</option>
                                        <option value="f">Tidak Diterima</option>
                                      </select>
                                    </div>
                                  </form>
                                  </div><!-- Box Body -->
                                  <div class="box-footer">
                                    <button type="button" id="save_user" class="btn btn-primary">Simpan</button>
                                  </div>
                                  </div><!-- Tab 1 -->
                                  <div class="tab-pane" id="tab_2user">
                                    <div class="box-body pad">
                                      <input type="hidden" name="id-for-getkode">
                                      <form id="form-ubah-jawaban-user">
                                        
                                      </form>
                                      <table id="tableuser" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                          <tr>
                                            <th width="1%">No.</th>
                                            <th>Pertanyaan</th>
                                            <th style="display: none;">Mirror Pertanyaan</th>
                                            <th>Jawaban</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          
                                        </tbody>
                                      </table>
                                      </div><!-- Box Body -->
                                      <div class="box-footer">
                                        <button type="button" id="btn-delete-penilaian-user" class="btn btn-danger pull-left">Hapus Pertanyaan</button>
                                        <button type="button" id="btn-ubah-penilaian-user" class="btn btn-primary pull-right">Simpan</button>
                                        <button type="button" id="btnSaveuser" onclick="savehasildetailuser()" class="btn btn-success pull-right">Muat Pertanyaan</button>
                                      </div>
                                      </div><!-- Tab 2 -->
                                      <div class="tab-pane" id="tab_3user">
                                        <div class="box-body pad">
                                          
                                          <form id="form-komentar-user">
                                            <input type="hidden" name="id-for-getkode">
                                            <div class="form-group">
                                              <label>Komentar :</label>
                                              <textarea class="form-control" rows="10" name="komentaruser" id="komentaruser"></textarea>
                                            </div>
                                          </form>
                                        </div>
                                        <div class="box-footer">
                                          <button type="button" id="save_komentar_user" class="btn btn-primary">Simpan</button>
                                        </div>
                                        </div><!-- Tab 3-->
                                        <div class="tab-pane" id="tab_4user">
                                          <div class="box-body pad">
                                          <form id="form-ask"></form>
                                          <table id="tableask" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                              <tr>
                                                <th>ref hasil</th>
                                                <th style="display: ;">ref pertanyaan</th>
                                                <th style="display: ;">Pertanyaan</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              
                                            </tbody>
                                          </table>
                                        </div>
                                        </div><!-- Tab 4-->
                                        </div><!-- Tab Content -->
                                        </div><!-- Navtab Custom -->
                                        </div><!-- Modal Body -->
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- END MODAL INPUT-->
                                  <!-- MODAL INPUT-->
                                  <div class="modal fade" id="modal-data-pertanyaan" role="dialog" data-backdrop="static">
                                    <div class="modal-dialog">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title"></h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="box-body pad">
                                            
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal fade" id="modal-data-pertanyaan-user" role="dialog" data-backdrop="static">
                                    <div class="modal-dialog">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title"></h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="box-body pad">
                                            
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal fade" id="modal-pelamar" role="dialog" data-backdrop="static">
                                    <div class="modal-dialog" style="width: 75%">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title"></h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="box-body pad">
                                          <form id="form-tambah-pelamar"></form>
                                          <div class="table-responsive mailbox-messages">
                                            <table id="tablepelamar" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                              <thead>
                                                <tr>
                                                  <th width="1%">No.</th>
                                                  <th>Nama</th>
                                                  <th>Tanggal Masuk</th>
                                                  <th>Posisi</th>
                                                  <th>Arahan</th>
                                                  <th>Tanggal Tes</th>
                                                  <th>Opsi</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                                        <!--
                                        <button type="button" id="btn-simpan-pelamar" class="btn btn-primary">Tambahkan Semua</button>
                                      -->
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div id="modal-konfirmasi" class="modal fade" role="dialog">
                                  <div class="modal-dialog modal-sm">
                                    <!-- Modal content-->
                                    <div class="modal-content"> 
                                      <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <center><h4 class="modal-title"></h4></center>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button>
                                        <button type="button" id="btnHapus"  class="btn btn-danger">Ya</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>