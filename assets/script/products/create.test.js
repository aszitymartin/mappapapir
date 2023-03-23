const save = require('./create');

var name = 'productname';
let price = 1500;

test('object assignment', () => {

  const o = {
    apiInfo : {
      status : true
    },
    product_name : {
      type : typeof(name),
      content : name
    },
    product_price : {
      type : typeof(price),
      content : price
    }
  }

  expect(save(o)).toEqual(
    {
      apiInfo : {
        status : true
      },
      product_name : {
        type : 'string',
        content : 'productname'
      },
      product_price : {
        type : 'number',
        content : 1500
      }
    }
  );
});