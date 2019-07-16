<?php
    $method = $this->uri->segment(2);    
    $method2 = $this->uri->segment(3);
    if ($method == '' || $method == 'index') $method = 'tags';
?>

<script>

    var server = "<?php echo base_url(); ?>";
    var config = {
        headers: {
            'Accept': 'application/json;odata=verbose'
        }
    };
    
    angular.module('ControlPanelModule', [])
    .controller('ControlPanelController', ['$scope', '$http', '$timeout', function($scope, $http, $timeout) {
        
    }]);
    
    jQuery(document).ready(function($) {
        $('#field-interests').tokenfield();
        $('#field-job_titles').tokenfield();
        $('#field-fields_of_study').tokenfield();
        $('#field-employers').tokenfield();
        $('#field-schools').tokenfield();
        $(".token-input").attr("placeholder", "Type something and hit enter");
    });
</script>
<div class="right" ng-app="ControlPanelModule" ng-controller="ControlPanelController">
    <div class="right_content">
        <div class="right_header clearfix">            
            <span class="left_side">
                <span class="title">Control Panel</span>                
            </span>                        
        </div>
        <div class="right_body">            
            <div class="main_col_header clearfix">
                <div class="table_list">
                    <a href="<?php echo base_url() . 'home'; ?>" class="<?php if ($method == "tags") echo "active"; ?>">Tags</a>
                </div>                
            </div>
            <div class="main_col_body">
                <div class="fb_row">
                    <?php echo $output; ?>
                </div>
                <div class="fb_row">
                    <div class="import_wrap clearfix" ng-if="(method == 'products') && method2 == ''">
                        <span class="right_side">
                            
                        </span>
                    </div>
                </div>                
            </div>
            
        </div>
    </div>
</div>
        