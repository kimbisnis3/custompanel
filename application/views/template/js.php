<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b></b>
	</div>
	<strong>Copyright &copy; 2018 <a href="">My Panel </a>.</strong> All rights reserved.
</footer>
</div>
</body>
</html>
<div class="control-sidebar-bg"></div>
<script src="<?php echo base_url() ?>assets/lte/plugins/jQuery/jQuery-2.2.3.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/dist/js/demo.js"></script>
<script src="<?php echo base_url(); ?>assets/lte/plugins/notify/bootstrap-notify.js"></script>
<script src="<?php echo base_url() ?>assets/lte/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/lte/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/lte/dist/js/app.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/ajaxupload/jquery.ajaxfileupload.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/lte/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/lte/plugins/pace/pace.js"></script>
<script src="<?php echo base_url() ?>assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/angularjs/angular.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/angularjs/ngStorage.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('') ?>assets/universe/universe.js"></script>  -->
<script type="text/javascript">
	var app = angular.module('uniapp', ['ngStorage']);
	app.config(['$localStorageProvider', '$sessionStorageProvider',
	    function($localStorageProvider, $sessionStorageProvider) {
	        $localStorageProvider.setKeyPrefix('uniapp-');
	        $sessionStorageProvider.setKeyPrefix('uniapp-');
	    }
	])
	var baseUrl = '<?php echo site_url('')?>';
	angular.module('uniapp').service('minilib', function($http, $resource, $rootScope, $location, $interval, $localStorage, socket, Upload) {

	    this.get = function(u, d, r, i = true, compress = true) {
	        $http({
	                method: 'GET',
	                url: baseUrl + u,
	                ignoreLoadingBar: (!i),
	                params: d
	            })
	            .then(function(res) {
	                if (compress) {
	                    let mydata = RJSON.unpack(res.data);
	                    r(mydata);
	                } else {
	                    r(res.data);
	                }
	            }, function(err) {
	                console.log(err.data);
	            })
	    }
	    this.post = function(u, d, r, i = true, compress = true) {
	        $http({
	                headers: {
	                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
	                },
	                transformRequest: function(data) {
	                    return $.param(data);
	                },
	                method: 'POST',
	                ignoreLoadingBar: (!i),
	                url: baseUrl + u,
	                data: d
	            })
	            .then(function(res) {
	                if (compress) {
	                    let mydata = RJSON.unpack(res.data);
	                    r(mydata);
	                } else {
	                    r(res.data);
	                }
	            }, function(err) {
	                console.log(err.data);
	            })
	    }

	    this.upload = function(u, d, r, p = function(evt) {
	        console.log(evt)
	    }, e = function(err) {
	        console.log(err)
	    }) {
	        Upload.upload({
	            url: baseUrl + u,
	            data: d
	        }).then(function(resp) {
	            r(resp.data);
	        }, function(resp) {
	            e(resp);
	        }, function(evt) {
	            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
	            p(progressPercentage, evt);
	            //console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
	        });
	    }
	    this.getIndex = function(arr, val, key = '') {
	        if (key == '') {
	            var zzz = arr.indexOf(val);
	        } else {
	            var zzz = arr.findIndex(function(s) {
	                return s[key] == val;
	            });
	        }
	        return zzz;
	    }
	    this.getObject = function(arr, val, key) {
	        var zzz = arr.findIndex(function(s) {
	            return s[key] == val;
	        });
	        return arr[zzz];
	    }
	    this.removeObject = function(arr, val, key = '') {
	        if (key == '') {
	            arr.splice(arr.indexOf(val), 1);
	        } else {
	            var zzz = arr.findIndex(function(s) {
	                return s[key] == val;
	            });
	            arr.splice(arr.indexOf(arr[zzz]), 1);
	            return arr;
	        }
	    }
	    this.clearHashkey = function(obj) {
	        return JSON.parse(angular.toJson(obj));
	    }
	    this.filterArray = function(arr, val, key) {
	        var arr_new = [];
	        var regex = new RegExp(val, 'ig');
	        var zzz = arr.findIndex(function(s) {
	            if (s[key] !== null) {
	                if (s[key].match(regex) !== null) {
	                    arr_new.push(s);
	                }
	            }
	        });
	        return arr_new;
	    }
	    this.getIndex = function(arr, val, key = '') {
	        if (key == '') {
	            var zzz = arr.indexOf(val);
	        } else {
	            var zzz = arr.findIndex(function(s) {
	                return s[key] == val;
	            });
	        }
	        return zzz;
	    }
	    this.filter_array = function(arr, key, val) {
	        var arr_new = [];
	        var regex = new RegExp(val, 'i');
	        var zzz = arr.findIndex(function(s) {
	            if ((s[key].toString()).match(regex) != null) {
	                arr_new.push(s);
	            }
	        });
	        return arr_new;
	    }
	    this.clear_hashkey = function(obj) {
	        var o = angular.toJson(obj);
	        return JSON.parse(o);
	    }
	})

	$(function() {
		if ($('#artikelx').length) {
	    	CKEDITOR.replace('artikelx')
		}
	})

	function select2() {
		$('.select2').select2({
		  placeholder: 'Select an option'
		});
	}
	
	function showNotif(title, msg, jenis) {
	    $.notify({
	        title: '<strong>' + title + '</strong>',
	        message: msg
	    }, {
	        type: jenis,
	        z_index: 2000,
	        allow_dismiss: true,
	        delay: 10,
	        animate: {
	            enter: 'animated fadeInDown',
	            exit: 'animated fadeOutUp'
	        },
	    }, );
	};
	$(".<?php echo $aktifgrup ?>").addClass("active");
	$(".<?php echo $aktifmenu ?>").addClass("active");
</script>
