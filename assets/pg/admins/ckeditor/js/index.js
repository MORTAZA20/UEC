src="ckeditor/ckeditor.js"

        CKEDITOR.replace('editor1');
        CKEDITOR.editorConfig = function( config ){
           config.language = 'ar';
           config.uiColor = '#f7b42c';
           config.height = 300;
           config.toolbarCanCollapse = true;
           config.contentsCss = 'margin-bottom: 15px;';
        };
        
        function sub_menu_open(){
            document.getElementById("req1").style.display = "none";
            document.getElementById("req2").style.display = "block";
            document.getElementById("sub-menu").style.height = "auto";
        }
        function sub_menu_close(){
            document.getElementById("req2").style.display = "none";
            document.getElementById("req1").style.display = "block";
            document.getElementById("sub-menu").style.height = "0px";
        }