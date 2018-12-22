<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('gambar/logo.png')?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata("username"); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    </form>
    <ul class="sidebar-menu">
      <li class="header">FRONT END WEBSITE</li>
      <li class="treeview artikel">
        <a href="<?php echo site_url('artikel'); ?>">
          <i class="fa fa-file-text-o"></i> <span>Artikel</span>
        </a>
      </li>
      <li class="treeview users">
        <a href="<?php echo site_url('users'); ?>">
          <i class="fa fa-key"></i> <span>Users</span>
        </a>
      </li>
      <li class="treeview master">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Pengaturan Tampilan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="link">
            <a href="<?php echo base_url('link'); ?>"><i class="fa fa-circle-o"></i> Link Terkait</a></li>
          </ul>
          <ul class="treeview-menu">
            <li class="element">
            <a href="<?php echo base_url('element'); ?>"><i class="fa fa-circle-o"></i> Element Gambar</a></li>
          </ul>
          <ul class="treeview-menu">
            <li class="elementteks">
            <a href="<?php echo base_url('elementteks'); ?>"><i class="fa fa-circle-o"></i> Element Teks</a></li>
          </ul>
          <ul class="treeview-menu">
            <li class="sekolah">
            <a href="<?php echo base_url('sekolah'); ?>"><i class="fa fa-circle-o"></i> Profil Sekolah</a></li>
          </ul>
          <ul class="treeview-menu">
            <li class="slideshow">
            <a href="<?php echo base_url('slideshow'); ?>"><i class="fa fa-circle-o"></i> Slideshow</a></li>
          </ul>
        </li>
      
      
    </ul>
  </section>
  
</aside>
<div class="content-wrapper">