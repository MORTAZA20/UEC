 
  $(document).ready(function() {
             $("#search-box").on("input", function() {
                 var searchValue = $(this).val().trim();
                 if (searchValue === "") {
                     $("#search-results").empty();
                     $(".search-results").hide();
                     return;
                 }
                 $.ajax({
                     type: "POST",
                     url: "assets/pg/SearchHome.php",
                     data: {
                         search: searchValue
                     },
                     success: function(data) {
                         if (data.trim() !== "") {
                             $(".search-results").html(data);
                             $(".search-results").show();
                         } else {
                             $(".search-results").html("<div>لا توجد نتائج.</div>");
                             $(".search-results").show();
                         }
                     }
                 });
             });
 
             $(document).on("click", ".search-results div", function() {
                 var resultText = $(this).text();
                 $("#search-box").val(resultText);
                 $(".search-results").hide();
             });
 
             $(document).on("click", function(event) {
                 if (!$(event.target).closest('.search-from').length) {
                     $(".search-results").hide();
                 }
             });
         });
   
 document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("search-results").style.display = "none";
        });

        function showResults() {
            document.getElementById("search-results").style.display = "block";
        }
            document.addEventListener("DOMContentLoaded", function() {
                    const xMark = document.querySelector(".fa-xmark");
                    const header = document.querySelector(".header");
        
                    xMark.addEventListener("click", function() {
                        header.classList.toggle("hide");
                    });
                });
        const searchIcon = document.querySelector('.search1');
        const searchBox = document.querySelector('.search-from');

        searchIcon.addEventListener('click', function() {
            if (window.getComputedStyle(searchBox).display === 'none') {
                searchBox.style.display = 'block';
            } else {
              
                searchBox.style.display = 'none';
            }
        });
 