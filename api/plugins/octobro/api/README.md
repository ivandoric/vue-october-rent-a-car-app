# API Framework for OctoberCMS

It's a plugin for OctoberCMS for you that want to create an extensible and easy to use API server.

## Features

- [CORS (Cross-origin Resource Sharing)](https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS) enabled
- Multiple request and respond formats available (form, json, xml, x-yaml)
- [JSON-API](http://jsonapi.org) compatible using [Fractal](http://fractal.thephpleague.com/)
- Extensible using OctoberCMS way

## Installation


1. [**Download**](https://github.com/octobroid/oc-api-plugin/archive/master.zip) this plugin and put to plugins directory (`plugins/octobro/api`).
2. Run `composer update` on your project root directory.

> Tips: if you want to follow this plugin, you can use this plugin as a submodule on your git project.

## Usage

This plugin is a base for your application API. You should create your "API" plugin for your application.

### Create Your Plugin

```
php artisan plugin:create Foo.Bar
```

In your `Plugin.php` file, we recommend you to put `Octobro.API` as plugin dependency.

```php
class Plugin extends PluginBase
{
	public $require = ['Octobro.API'];
	
```

### Define the REST API Routes

Create `routes.php` using this starter template.

```php
Route::group([
	'prefix'     => 'api/v1',
	'namespace'  => 'Foo\Bar\ApiControllers',
	'middleware' => 'cors'
], function() {
	
	//	
	// Your public resources should be here
	//
	
});
```

Don't forget to change the Controllers `namespace` on your plugin.

### Create Your App Resources

For example in an e-commerce application, we want to open the products catalog API.

Put the URL to your `plugins/foo/bar/routes.php`

```php
Route::get('products', 'Products@index');
Route::get('products/{id}', 'Products@show');

Route::post('orders', 'Orders@store');
```

Create the `plugins/foo/bar/apicontrollers/Products.php` file.

```php
<?php namespace Foo\Bar\ApiControllers;

use Octobro\API\Classes\ApiController;
use Foo\Bar\Models\Product;
use Foo\Bar\Transformers\ProductTransformer;

class Products extends ApiController
{
    public function index()
    {
        $products = Product::get();

        return $this->respondwithCollection($products, new ProductTransformer);
    }

    public function show($id)
    {
    	$product = Product::find($id);

    	return $this->respondwithItem($product, new ProductTransformer);
    }
}

```

### Create The Transformers

Transformer will help you to transform data from a model object to set of array including relationship using `include` and `exclude` query.

For example in this case, we create the `plugins/foo/bar/transformers/ProductTransformer.php`

```php
<?php namespace Foo\Bar\Transformers;

use Octobro\API\Classes\Transformer;
use Foo\Bar\Models\Product;

class ProductTransformer extends Transformer
{
    // Related transformer that can be included
    public $availableIncludes = [
    	'categories',
    	'brand',
    ];
    
    // Related transformer that will be included by default
    public $defaultIncludes = [
    	'categories',
    ];

    public function transform(Product $product)
    {
        return [
            'id'          => (int) $product->id,
            'sku'         => $product->sku,
            'name'        => $product->name,
            'description' => $product->description,
            'price'       => $product->price,
            'sale_price'  => $product->sale_price,
            'image'       => $this->image($product->image),
            'gallery'     => $this->images($product->gallery),
            'created_at'  => date($product->created_at),
        ];
    }
    
    public function includeCategories(Product $product)
    {
        return $this->collection($product->categories, new CategoryTransformer);
    }
    
    public function includeBrand(Product $product)
    {
        return $this->item($product->brand, new BrandTransformer);
    }
}

```

That's it! You're successfully created the API in easy way! There are ton of features that very usable for your scalable and extensible application.

### Trying the API

We recommend you to use API client like [Postman](https://www.getpostman.com/) or [Insomnia](https://insomnia.rest/) for easy testing.

**Basic Call**

`GET http://example.com/api/v1/products`

The response will be.

```json
{
    "data": [
        {
            "id": 1,
            "name": "Sample Prouct",
            ...
        },
        ...
    ]
}
```

**Using Include Query**

`GET http://example.com/api/v1/products?include=brand,categories`

```json
{
    "data": [
        {
            "id": 1,
            "name": "Sample Prouct",

            "brand": {
                "data": {
                    "id": 21,
                    "name": "Nike",
                    ...
                }
            },

            "categories: {
                "data": [
                    {
                        "id": 45,
                        "name": "Hot Product",
                        ...
                    },
                    {
                        "id": 8,
                        "name": "Shoes",
                        ...
                    }
                ]
            }
        }
    ]
}
```

**Using Paginator**

`GET http://example.com/api/v1/products?page=2,number=20`

```json
{
    "data": [
        {
            "id": 1,
            "name": "Sample Prouct",
            ...
        },
        ...
    ],
    "meta": {
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 20,
            "current_page": 2,
            "total_pages": 10,
            "links": {
                "previous": "http://example.com/api/v1/products?page=1",
                "next": "http://example.com/api/v1/products?page=3"
            }
        }
    }
}
```


### Configuring Serializer

By default this plugin is using `DataArraySerializer` from [Fractal](https://fractal.thephpleague.com). If you want to use another serializer, there are another options like `ArraySerializer` or `JsonApiSerializer`.

To change the serializer you can extend it on your own `Plugin.php`.

```php
use Octobro\API\Classes\ApiController;
use League\Fractal\Serializer\JsonApiSerializer;

class Plugin extends PluginBase
{
    public $require = ['Octobro.API'];

    public function boot()
    {
    	ApiController::extend(function($controller) {
    		$controller->fractal->setSerializer(new JsonApiSerializer());
    	});
    }
}


```

## Recommended Plugins

We are building another API-enabled plugins that can be used easily!

- [OAuth2 API](https://github.com/octobroid/oc-oauth2-plugin) (using RainLab.User)
- [RainLab.Blog API](https://github.com/octobroid/oc-blogapi-plugin)
- [Flynsarmy.SocialLogin API](https://github.com/octobroid/oc-socialloginapi-plugin)

## Extending Plugins

Need to extend the plugin? We can just add some lines to add the fields of data, or even creating or manipulating includes query.

In this example we want to extend `ProductTransformer.php`.

### Adding Fields

```php
// Add this on your plugin boot() method

ProductTransformer::extend(function($transformer) {

    // Add field one by one
    $transformer->addField('tags', function($product) {
        return $product->tags->toArray();
    });
    
    // Add field based on object attribute
    // In this case, if the Product has tax attribute ($product->tax)
    $transformer->addField('tax');
    
    // Wanna add more fields based on attributes?
    // You can put it all together
    $transformer->addFields(['url', 'color', 'is_recommended']);
});
```


### Adding Includes

```php
// Add this on your plugin boot() method

ProductTransformer::extend(function($transformer) {

    // For example it has reviews relation
    $transformer->addInclude('reviews', function($product) use ($transfomer) {
        return $transformer->collection($product->reviews, new ReviewTransfomer);
    });
    
    // Or if it has single relation
    $transformer->addInclude('brand', function($product) use ($transfomer) {
        return $transformer->item($product->brand, new BrandTransformer);
    });    
});
```

## Composer Packages Used

- [league/fractal](https://packagist.org/packages/league/fractal)
- [barryvdh/laravel-cors](https://packagist.org/packages/barryvdh/laravel-cors)


## License

The OctoberCMS platform is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).