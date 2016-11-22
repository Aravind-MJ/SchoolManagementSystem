(function() {
    Dropzone.options.bookImage = {
        paramName           :       "image", // The name that will be used to transfer the file
        maxFilesize         :       2, // MB
        dictDefaultMessage  :       "Drop File here or Click to upload Image",
        thumbnailWidth      :       "300",
        thumbnailHeight     :       "300",
        accept              :       function(file, done) { done() },
        success             :       uploadSuccess,
        complete            :       uploadCompleted
    };

    function uploadSuccess(data, file) {

    }

    function uploadCompleted(data) {
        if(data.status == "success")
        {
			//$('.dz-success-mark').html('');
			$('.dz-error-mark').html('')
            return;
        }else{
			$('.dz-success-mark').html('');
            return;
		}
    }
})();