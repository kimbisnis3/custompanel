<?php
//for prevent unauthorized user by topsi
$title      = 'Penilaian Karyawan';
$ref_access_user = $this->session->userdata('ref_access_user');
$get_ref_action_user = $this->T_akses->getaccessuser($title);
$ref_action_user    = $get_ref_action_user->id;
$getgranted         = $this->T_akses->grantedaccess($ref_access_user,$ref_action_user);
$granted    = $getgranted->jml;
if ($granted == 0) {
$this->session->set_flashdata('messageakses', 'Anda Tidak Punya Akses Ke Halaman Tersebut');
redirect('landingpage'); }
?>

<!--For clicked datatables-->
<script type="text/javascript">
$('#table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
        idx = 0;
            }else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        if (table.row( this ).index() > -1) {
          idx = table.row( this ).index();
        }
            }
        }); 
</script>
,
                        "action"      => "
                        <a href='javascript:void(0)' class='btn btn-sm btn-warning' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$r->id.")' id='btn-edit' ".$get_u_button."><i class='glyphicon glyphicon-pencil'></i></a>
                        <a href='javascript:void(0)' class='btn btn-sm btn-primary' data-toggle='tooltip' data-placement='top' title='Berkas' onclick='open_berkas(".$r->id.")' id='btn-edit' ".$get_u_button."><i class='glyphicon glyphicon-paperclip'></i></a>
                        <a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Void' onclick='hapus(".$r->id.")' ".$get_d_button."><i class='glyphicon glyphicon-trash'></i></a>"
,
                        "action"      => "
                        <a href='javascript:void(0)' class='btn btn-sm btn-warning' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$r->id.")' ".$get_u_button."><i class='glyphicon glyphicon-pencil'></i></a>
                        <a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Void' onclick='hapus(".$r->id.")' ".$get_d_button."><i class='glyphicon glyphicon-trash'></i></a>
                        <a href='javascript:void(0)' class='btn btn-sm btn-success' data-toggle='tooltip' data-placement='top' title='Tambah Pelamar' onclick='tambahpelamar(".$r->id.")' ".$get_u_button."><i class='glyphicon glyphicon-user'></i></a>
                         <a href='javascript:void(0)' class='btn btn-sm btn-primary' data-toggle='tooltip' data-placement='top' title='Print' onclick='printf(".$r->id.")' ".$get_u_button."><i class='glyphicon glyphicon-print'></i></a>"


    function aksestombol($title){
        $ref_access_user = $this->session->userdata('ref_access_user');
        $get_ref_action_user = $this->T_akses->getaccessuser($title);
        $ref_action_user    = $get_ref_action_user->id;

        $get_i          = $this->T_akses->getopsi_i($ref_access_user,$ref_action_user);
        $get_u          = $this->T_akses->getopsi_u($ref_access_user,$ref_action_user);
        $get_d          = $this->T_akses->getopsi_d($ref_access_user,$ref_action_user);
        $get_o          = $this->T_akses->getopsi_o($ref_access_user,$ref_action_user);

        $i  = $get_i->i ;
        $u  = $get_u->u ;
        $d  = $get_d->d ;
        $o  = $get_o->o ;

        $i_button   = "style = 'display : '";
        $u_button   = "style = 'display : '";
        $d_button   = "style = 'display : '";
        $o_button   = "style = 'display : '";

        if ($i == 't') {
            $get_i_button = $i_button ;
        } else {
            $get_i_button =  "style = 'display : none'";
        };

        if ($u == 't') {
            $get_u_button = $u_button ;
        } else {
            $get_u_button =  "style = 'display : none'";
        };

        if ($d == 't') {
            $get_d_button = $d_button ;
        } else {
            $get_d_button =  "style = 'display : none'";
        };

        if ($o == 't') {
            $get_o_button = $o_button ;
        } else {
            $get_o_button =  "style = 'display : none'";
        };
    }
script enter for save    
$('[name="pencapaian"]').bind("entersave",function(e){
       savepersen();
      });

    $('[name="pencapaian"]').keyup(function(e){
      if(e.keyCode == 13)
      {
        $(this).trigger("entersave");
      }
      });
function getnolunasnoc()
    {
        $sql    = 
        "SELECT DISTINCT
            mkaryawan.nik,
            mkaryawan.nama,
            mkaryawan.ref_mgolongan,
            mjabatan.kode kodejabatan,
            mkaryawan.rekening,
            mkompgaji.kode,
            mkompgaji.nama AS namakomp,
            mnomkomp.ID,
            mnomkomp.nominal,
            mnomkomp.periode,
            mnomkomp.xcicilan,
            mnomkomp.ref_kar,
            mnomkomp.ref_komp,
            mnomkomp.angsuran,
            mnomkomp.sisa,
            mnomkomp.status,
            mnomkomp.ket,
            mkompgaji.io,
            ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper ) total,
            COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper ) sisacicilan,
        CASE
            
            WHEN (
            COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) > COALESCE ( mnomkomp.angsuran, 0 ) AND mnomkomp.periode IS TRUE THEN
                'a' 
                WHEN ((
                COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) < COALESCE ( mnomkomp.angsuran, 0 ) 
                AND (
                    COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) > 0) AND mnomkomp.periode IS TRUE THEN
                    's' 
                    WHEN ((
                        COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) = 0) AND mnomkomp.periode IS TRUE THEN
                        'f' 
                        WHEN ((
                            COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) IS NULL) AND mnomkomp.periode IS TRUE THEN
                            'n' 
                            WHEN mnomkomp.periode IS NULL THEN
                            'p' 
                        END statusmod,
        CASE
                
                WHEN ((
                    COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) > COALESCE ( mnomkomp.angsuran, 0 )) AND mnomkomp.periode IS TRUE THEN
                    ( mnomkomp.angsuran ) 
                    WHEN ((
                    COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) < COALESCE ( mnomkomp.angsuran, 0 ) 
                    AND (
                        COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) > 0) AND mnomkomp.periode IS TRUE THEN
                        ( mnomkomp.sisa ) 
                        WHEN ((
                            COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) = 0) AND mnomkomp.periode IS TRUE THEN
                            0 
                            WHEN ((
                                COALESCE ( mnomkomp.nominal, 0 ) - ( SELECT COALESCE ( SUM ( xgajibulan.nominal ), 0 ) FROM xgajibulan WHERE mnomkomp.ID = xgajibulan.kodeper )) IS NULL) AND mnomkomp.periode IS TRUE THEN
                                0 
                                WHEN (mnomkomp.periode) IS NULL THEN
                                COALESCE ( mnomkomp.nominal, 0 ) 
                            END dibayar 
        FROM
            mnomkomp
            LEFT OUTER JOIN mkaryawan ON mnomkomp.ref_kar = mkaryawan.nik
            LEFT OUTER JOIN mkarjab ON ( mkarjab.ref_kar = mkaryawan.nik AND mkarjab.DEFAULT = TRUE )
            LEFT OUTER JOIN mjabatan ON mjabatan.kode = mkarjab.ref_jab
            LEFT OUTER JOIN mkompgaji ON mkompgaji.kode = mnomkomp.ref_komp
            LEFT OUTER JOIN xgajibulan ON xgajibulan.kodeper = mnomkomp.ID 
        WHERE
        mnomkomp.periode IS NOT FALSE";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function maxangsuran($kodeper)
    {
        $sql    = 
        "SELECT 
            SUM( xgajibulan.nominal ) jml
        FROM
            xgajibulan 
        WHERE
            xgajibulan.kodeper = '$kodeper'
        GROUP BY 
            xgajibulan.kodeper";

        $query = $this->db->query($sql);
        return $query->result();
    }