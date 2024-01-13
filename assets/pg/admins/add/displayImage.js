
function displayImage(){

    const input = document.getElementById("upload-input");
    const file = input.files[0];
  
    if(file){
  
      const reader = new FileReader();
  
      reader.onload = function(event){
        const imageDataUrl = event.target.result;  
        updateImageSrc(imageDataUrl);
      };
      reader.readAsDataURL(file);
    }
  
  }
  function updateImageSrc(imageUrl){
    document.getElementById('uploaded-image').src = imageUrl;
  }