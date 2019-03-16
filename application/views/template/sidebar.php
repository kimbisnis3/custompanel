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
    <ul class="sidebar-menu">
      <li class="header">FRONT END WEBSITE</li>
      <li class="treeview berita">
        <a href="<?php echo site_url('berita'); ?>">
          <i class="fa fa-newspaper-o"></i> <span>Berita</span>
        </a>
      </li>
      <li class="treeview profil">
        <a href="<?php echo site_url('profil'); ?>">
          <i class="fa fa-user"></i> <span>Profil</span>
        </a>
      </li>
      <li class="treeview ktgproduk">
        <a href="<?php echo site_url('ktgproduk'); ?>">
          <i class="fa fa-link"></i> <span>Kategori Produk</span>
        </a>
      </li>
      <li class="treeview produk">
        <a href="<?php echo site_url('produk'); ?>">
          <i class="fa fa-dropbox"></i> <span>Produk</span>
        </a>
      </li>
      <li class="treeview ktgportofolio">
        <a href="<?php echo site_url('ktgportofolio'); ?>">
          <i class="fa fa-link"></i> <span>Kategori Portofolio</span>
        </a>
      </li>
      <li class="treeview portofolio">
        <a href="<?php echo site_url('portofolio'); ?>">
          <i class="fa fa-file-text-o"></i> <span>Portofolio</span>
        </a>
      </li>
      <li class="treeview user">
        <a href="<?php echo site_url('user'); ?>">
          <i class="fa fa-key"></i> <span>User</span>
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
          <li class="elementgambar">
            <a href="<?php echo base_url('elementgambar'); ?>"><i class="fa fa-circle-o"></i> Element Gambar</a>
          </li>
        </ul>
        <ul class="treeview-menu">
          <li class="elementteks">
            <a href="<?php echo base_url('elementteks'); ?>"><i class="fa fa-circle-o"></i> Element Teks</a>
          </li>
        </ul>
        <ul class="treeview-menu">
          <li class="slideshow">
            <a href="<?php echo base_url('slideshow'); ?>"><i class="fa fa-circle-o"></i> Slideshow</a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
</aside>