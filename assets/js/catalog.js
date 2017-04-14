$(function() {
    Catalog.init();
});

var Catalog = function () {

    var actions = function(){

        $(document)
            // Add new product
            .on('click', 'a[data-action="add-product"]', function(){
                getProductEditForm(0);
                return false;
            })
            // Edit product
            .on('click', 'a[data-action="edit-product"]', function(){
                var id = $(this).attr('data-id');

                getProductEditForm(id);
                return false;
            })
            // Delete product
            .on('click', 'a[data-action="delete-product"]', function(){
                var id = $(this).attr('data-id');
                deleteProduct(id);    
                
                return false;
            })
            // Remove product
            .on('click', 'a[data-action="recover-product"]', function(){
            	var id = $(this).attr('data-id');
                recoverProduct(id);    
                
                return false;	
            })
            // Save product
            .on('click', 'button[data-action="save-product"]', function(){
                
                var form = $('#edit-product-form');

                var data = {
                    id: form.find('input[name=id]').val(),
                    name: form.find('input[name=name]').val(),
                    description: form.find('textarea[name=description]').val(),
                    status: form.find('select[name=status] option:selected').val(),
                    price: form.find('input[name=price]').val() 
                }

                var errors = {};

                if (!data.name.length) {
                    errors["name"] = 'Введите название товара';
                }

                if (!data.status.length) {
                    errors["status"] = 'Выберите статус товара';
                }

                if (!data.price.length) {
                    errors["price"] = 'Введите цену товара';
                }

                if ($.isEmptyObject(errors)) {

                    $.ajax({
                        url: '/index/save-product-ajax',
                        method: 'post',
                        dataType: 'json',
                        data: data,
                        success: function(response){
                            if (response.success == true) {
                            	var modal = $('#edit-product-modal');

                                modal.modal('hide');
                                modal.on('hidden.bs.modal', function (e) {
								  	getCatalogAjax();
								})
                            }
                        }
                    })
                } else {

                    var alert = form.find('.alert')

                    for (property in errors) {
                        alert.append(errors[property] + '<br />');
                        form.find('*[name='+property+']').closest('.form-group').addClass('has-error');
                    }

                    alert.fadeIn();

                } 

                return false;
            })
            // filters
            .on('change', '.page-actions .controls select', function(){
            	var filterName = $(this).attr('name');
            	var filterValue = $(this).find('option:selected').val();
        		getCatalogAjax([filterName, filterValue]);
            })
            // pagination
            .on('click', '.page-actions .pagination a[data-page]', function(){
            	var filterValue = $(this).attr('data-page');
        		getCatalogAjax(['page', filterValue]);	
            })

   //          window.addEventListener("hashchange", function(e) {
   //  			getCatalogAjax();
   //  			console.log('3')
			// })
    }

    function getCatalogAjax(parameters){

	    var get = window.location.search;    
	    var getParameters = {}

	    if (get) {
	        get = get.slice(1)
	                 .split('&');
	        var getCount = get.length;
	        if (getCount) {
	            for (var i = 0; i < getCount; i++) {
	                var param = get[i].split('=');
	                if (param.length == 2) {
	                	getParameters[param[0]] = param[1];
	                }
	            }
	        } 
	    }

	    if (typeof parameters !== 'undefined' && parameters.length == 2) {
	    	getParameters[parameters[0]] = parameters[1];
	    }

    	$.ajax({
			url: '/index/get-catalog-ajax',
			method: 'POST',
			dataType: 'json',
			data: getParameters,
			success: function(response){
				if (response.success) {

					var search = [];

					for (property in response.request) {

						if (property == 'page' && response.request[property] == 1) {
							continue;
						}

						search.push(property + '=' + response.request[property]);
					}

					var url = window.location.pathname + '?' + search.join('&');
					history.pushState({type: 'url'}, 'url', url); 

					$('.products-list').html(response.products);
				}
			}
		})
    }

    function getProductEditForm(productId){
        $.ajax({
            url: '/index/edit-product-ajax',
            method: 'post',
            dataType: 'json',
            data: {
                id: productId
            },
            success: function(response){
                var form = $('#edit-product-modal');
                form.find('.modal-title').html(response.title);
                form.find('.modal-body').html(response.form);
                form.modal('show');
            }
        })
    }

    function deleteProduct(productId){
        $.ajax({
            url: '/index/delete-product-ajax',
            method: 'post',
            dataType: 'json',
            data: {
                id: productId
            },
            success: function(response){
                if (response.success == true) {

                    var container = $('#product-' + productId);
                    container.append('<div class="cover"><span class="cover-label">Удалено!</span><a href="#" class="btn btn-sm btn-danger" data-action="recover-product" data-id="' + productId + '">Восстановить</a></div>')
							 .find('.product-content')
							 .animate({
								opacity: .35
							 },  150);
                }
            }
        })
    }

    function recoverProduct(productId){
        $.ajax({
            url: '/index/recover-product-ajax',
            method: 'post',
            dataType: 'json',
            data: {
                id: productId
            },
            success: function(response){
                if (response.success == true) {

                    var container = $('#product-' + productId);
                    container.find('.cover').remove();
                    container.find('.product-content')
							 .animate({
								opacity: 1
							 },  150);
                }
            }
        })
    }

    return {
        init: function () {
            actions();
        }
    };
}();