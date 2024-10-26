import { useEffect, useState } from "react"
import { Link } from "react-router-dom";

function Products() {
    const [products,setProducts] = useState([]);
    const [selectedProducts,setSelectedProducts] = useState([]);
    const [loading,setLoading] = useState();

    const fetchProducts = async () => {
        try {
            const response = await fetch('http://localhost/scandiwebTest/api/getProducts');
            const data = await response.json();
            setProducts(data.products);
        } catch (error) {
            console.error('Error fetching products:', error);
        } finally {
            setLoading(false)
        }
    };
    useEffect(()=>{
        fetchProducts();
    },[]);

    const renderAttributes = (specificAttribute) => {
        const attributes = JSON.parse(specificAttribute);
        return Object.entries(attributes).map(([key, value]) => (
            <p key={key}>{`${key.charAt(0).toUpperCase() + key.slice(1)}: ${value}`}</p>
    ));};

// Handle checkbox change
const handleCheckboxChange = (e, productId) => {
    if (e.target.checked) {
      setSelectedProducts([...selectedProducts, productId]);
    } else {
      setSelectedProducts(selectedProducts.filter(id => id !== productId));
    }
};

// Handle Mass Delete
    const handleMassDelete = async () =>{
        if (selectedProducts.length === 0) return;
        try {
            const response = await fetch('http://localhost/scandiwebTest/api/deleteProduct', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                },
                body: JSON.stringify({ SKUs: selectedProducts }),
              });
        
            if (response.ok) {
                // Update the product list by filtering out deleted products
                setProducts(products.filter(product => !selectedProducts.includes(product.sku)));
                //refetch-data
                //fetchProducts();
                setSelectedProducts([]);
              } 

        } catch (error) {
            console.error('Error:', error);
        }
    };

  return (
    <main className="container">
        <div className="borderBottom d-flex flex-wrap justify-content-between align-items-center pb-4">
            <h1 className="">Products List</h1>
            <div className="">
                <Link to={'/add-product'} className="btn add-btn">ADD</Link>
                <button id="delete-product-btn" className="btn" 
                    onClick={handleMassDelete} 
                    disabled={selectedProducts.length === 0}>
                    MASS DELETE
                </button>
            </div>
        </div>
        <div className="row m-auto mt-md-5 mt-3">
        {loading ? (
        <p>Loading products...</p>
            ) :(
                products.length > 0 ?( 
        <div className="row m-auto mt-md-5 mt-3">
        {products.map((product,index) => (
        <div key={index} className="form-check  col-12 col-md-3">
            <div  className="p-3 m-2 border-dev text-center">
                <input className="form-check-input" 
                    type="checkbox" 
                    value={product.id} 
                    id="delete-checkbox"
                    checked={selectedProducts.includes(product.sku)}
                    onChange={(e) => handleCheckboxChange(e, product.sku)}
                    />
                <label className="form-check-label" htmlFor="delete-checkbox">
                    <div className="" key={product.sku}>
                        <p>{product.sku}</p>
                        <p>{product.name}</p>
                        <p>{product.price} $</p>
                        <>{renderAttributes(product.specific_attribute)}</>
                    </div>
                </label>
            </div>
        </div>
    ))}
        </div>
                ):<p>No products available</p>
    )}
        </div>
    </main>
  )
}

export default Products