$(document).ready(function(){
    cat();
    cathome();
    brand();
    product();
    producthome();
    gethomeproduts();

    // Fetch categories when the page loads
    function cat(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {category: 1},
            success: function(data){
                $("#get_category").html(data);
            }
        });
    }

    // Fetch home categories when the page loads
    function cathome(){
        $.ajax({
            url: "homeaction.php",
            method: "POST",
            data: {categoryhome: 1},
            success: function(data){
                $("#get_category_home").html(data);
            }
        });
    }

    // Fetch brands when the page loads
    function brand(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {brand: 1},
            success: function(data){
                $("#get_brand").html(data);
            }
        });
    }

    // Fetch products when the page loads
    function product(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getProduct: 1},
            success: function(data){
                $("#get_product").html(data);
            }
        });
    }

    // Fetch home products when the page loads
    function producthome(){
        $.ajax({
            url: "homeaction.php",
            method: "POST",
            data: {getProducthome: 1},
            success: function(data){
                $("#get_product_home").html(data);
            }
        });
    }

    // Fetch home products for a specific range
    function gethomeproduts(){
        $.ajax({
            url: "homeaction.php",
            method: "POST",
            data: {gethomeProduct: 1},
            success: function(data){
                $("#get_home_product").html(data);
            }
        });
    }

    // Event delegation for category clicks
    $(document).on("click", ".categoryhome", function(event){
        event.preventDefault();
        var cid = $(this).attr('cid');
        $("#get_product").html("<h3>Loading...</h3>");

        $.ajax({
            url: "homeaction.php",
            method: "POST",
            data: {get_seleted_Category: 1, cat_id: cid},
            success: function(data){
                $("#get_product").html(data);
                if ($("body").width() < 480){
                    $("body").scrollTop(683);
                }
            }
        });
    });

    // Event delegation for brand clicks
    $(document).on("click", ".selectBrand", function(event){
        event.preventDefault();
        var bid = $(this).attr('bid');
        $("#get_product").html("<h3>Loading...</h3>");

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {selectBrand: 1, brand_id: bid},
            success: function(data){
                $("#get_product").html(data);
                if ($("body").width() < 480){
                    $("body").scrollTop(683);
                }
            }
        });
    });

    // Search functionality
    $("#search_btn").click(function(){
        $("#get_product").html("<h3>Loading...</h3>");
        var keyword = $("#search").val();
        if(keyword != ""){
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {search: 1, keyword: keyword},
                success: function(data){
                    $("#get_product").html(data);
                    if ($("body").width() < 480){
                        $("body").scrollTop(683);
                    }
                }
            });
        }
    });

    // Event delegation for adding product to cart
    $(document).on("click", "#product", function(event){
        event.preventDefault();
        var pid = $(this).attr("pid");
        $(".overlay").show();

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {addToCart: 1, proId: pid},
            success: function(data){
                count_item();
                getCartItem();
                $('#product_msg').html(data);
                $('.overlay').hide();
            }
        });
    });

    // Count user cart items
    function count_item(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {count_item: 1},
            success: function(data){
                $(".badge").html(data);
            }
        });
    }

    // Fetch Cart items from Database
    function getCartItem(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {Common: 1, getCartItem: 1},
            success: function(data){
                $("#cart_product").html(data);
                net_total();
            }
        });
    }

    // Calculate net total for cart items
    function net_total(){
        var net_total = 0;
        $('.qty').each(function(){
            var row = $(this).parent().parent();
            var price = row.find('.price').val();
            var total = price * $(this).val();
            row.find('.total').val(total);
        });

        $('.total').each(function(){
            net_total += parseFloat($(this).val());
        });

        $('.net_total').html("Total: RM " + net_total);
    }

    // Checkout details
    function checkOutDetails(){
        $('.overlay').show();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {Common: 1, checkOutDetails: 1},
            success: function(data){
                $('.overlay').hide();
                $("#cart_checkout").html(data);
                net_total();
            }
        });
    }

    // Event delegation for removing item from cart
    $(document).on("click", ".remove", function(event){
        event.preventDefault();
        var remove = $(this).parent().parent().parent();
        var remove_id = remove.find(".remove").attr("remove_id");

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {removeItemFromCart: 1, rid: remove_id},
            success: function(data){
                $("#cart_msg").html(data);
                checkOutDetails();
            }
        });
    });

    // Event delegation for updating cart item quantity
    $(document).on("click", ".update", function(event){
        event.preventDefault();
        var update = $(this).parent().parent().parent();
        var update_id = update.find(".update").attr("update_id");
        var qty = update.find(".qty").val();

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {updateCartItem: 1, update_id: update_id, qty: qty},
            success: function(data){
                $("#cart_msg").html(data);
                checkOutDetails();
            }
        });
    });

    // Pagination
    function page(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {page: 1},
            success: function(data){
                $("#pageno").html(data);
            }
        });
    }

    // Event delegation for pagination
    $(document).on("click", "#page", function(){
        var pn = $(this).attr("page");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getProduct: 1, setPage: 1, pageNumber: pn},
            success: function(data){
                $("#get_product").html(data);
            }
        });
    });

    // Initialize
    page();
    count_item();
    getCartItem();
    checkOutDetails();
});
