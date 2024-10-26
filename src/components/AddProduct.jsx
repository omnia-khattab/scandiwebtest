import { useState } from "react";
import { useForm } from "react-hook-form";
import { Link, useNavigate } from "react-router-dom";

function AddProduct() {
    const productAttributes = {
      DVD: {
        description: "Please, provide size",
        attributes: [{ name: "size", label: "Size (MB)", type: "number" }]
      },
      Book: {
        description: "Please, provide weight",
        attributes: [{ name: "weight", label: "Weight (Kg)", type: "number" }]
      },
      Furniture: {
        description: "Please, provide dimensions",
        attributes: [
          { name: "height", label: "Height (CM)", type: "number" },
          { name: "width", label: "Width (CM)", type: "number" },
          { name: "length", label: "Length (CM)", type: "number" }
        ]
      }
     };

  const {
    register,
    handleSubmit,
    setValue,
    formState: { errors },
  } = useForm();
  const [productType, setProductType] = useState("");
  const [apiError,setApiError]= useState([]);
  const navigate = useNavigate();

  const handleTypeChange = (e) => {
    const selectedType = e.target.value;
    setProductType(selectedType);

    // Reset form specific attributes values when changing product type
    productAttributes[selectedType]?.attributes?.forEach((attr) => setValue(attr.name, ""));
  };

const onSubmit = async (data) => {
  //clear the other attributes from the data object
    if (productType === "DVD") {
        delete data.weight;
        delete data.height;
        delete data.width;
        delete data.length;
      } else if (productType === "Book") {
        delete data.size;
        delete data.height;
        delete data.width;
        delete data.length;
      } else if (productType === "Furniture") {
        delete data.size;
        delete data.weight;
      }
    //console.log(data);

    //send data to the API
    try {
        const response = await fetch('http://localhost/scandiwebTest/api/addProduct',{
            method:"POST",
            headers:{"Content-Type": "application/json"},
            body: JSON.stringify(data),
        });

        if (!response.ok) {
            const apiError= await response.json();
            setApiError(apiError.message ? apiError.message : "An unknown error occurred");
            throw new Error(apiError.message ||"Failed to submit product");
        }
        if(response.ok){
            setApiError("");
            navigate("/")
        }

    } catch (error) {
        console.error("Error submitting the form:", error);
    }
  };
return (
    <main className="container">
      <form onSubmit={handleSubmit(onSubmit)} id="product_form">
        <div className="borderBottom d-flex justify-content-between align-items-center pb-4">
          <h1 className="">Product Add</h1>
          <div className="">
            <button className="btn" type="submit">
              Save
            </button>
            <Link to={"/"} className="btn cancel-btn">
              Cancel
            </Link>
          </div>
        </div>

        {/* API Error */}
            {
                apiError && 
                <div>
                    <p className="text-danger">{apiError}</p>
                </div>
            }
        {/* Form Fields */}
        <div className="w-75 w-md-50">
          <div className="mb-3">
            <label htmlFor="sku" className="form-label">
              SKU
            </label>
            <input
              {...register("sku",
               {
                required: "sku is required",
                minLength: { value: 3, message: "Minimum length is 3" },
                maxLength: { value: 100, message: "Maximum length is 100" },
               }
              )}
              type="text"
              className="form-control"
              id="sku"
              placeholder="sku"
            />
            {errors.sku && (
              <small className="text-danger">{errors.sku.message}</small>
            )}
          </div>
          <div className="mb-3">
            <label htmlFor="name" className="form-label">
              Name
            </label>
            <input
              {...register("name", {
                required: "name is required",
                minLength: { value: 3, message: "Minimum length is 3" },
                maxLength: { value: 100, message: "Maximum length is 100" },
              })}
              type="text"
              className="form-control"
              id="name"
              placeholder="name"
            />
            {errors.name && (
              <small className="text-danger">{errors.name.message}</small>
            )}
          </div>
          <div className="mb-3">
            <label htmlFor="price" className="form-label">
              Price
            </label>
            <input
              {...register("price", {
                required: "Price is required",
                valueAsNumber: true,
              })}
              type="number"
              step={"any"}
              className="form-control"
              id="price"
              placeholder="price"
            />
            {errors.price && (
              <small className="text-danger">{errors.price.message}</small>
            )}
          </div>

          {/* Product types */}
          <div className="mb-3">
            <label htmlFor="productType" className="form-label">
              Product Type
            </label>
            <select
              id="productType"
              {...register("productType", {
                required: "Product Type is required",
              })}
              value={productType}
              onChange={handleTypeChange}
              className="form-select"
              aria-label="Default select example"
            >
              <option value="">Select Product Type</option>
              <option id="DVD" value="DVD">
                DVD
              </option>
              <option id="Book" value="Book">
                Book
              </option>
              <option id="Furniture" value="Furniture">
                Furniture
              </option>
            </select>
            {errors.productType && (
              <small className="text-danger">
                {errors.productType.message}
              </small>
            )}
          </div>
          

          {productAttributes[productType] && (
          <>
            <div className="mb-3">
              <p className="text-primary">{productAttributes[productType].description}</p>
            </div>
            {productAttributes[productType].attributes.map(({ name, label, type }) => (
                  <div className="mb-3" key={name}>
                    <label htmlFor={name} className="form-label">
                      {label}
                    </label>
                    <input
                      {...register(name, { required: `${label} is required`, valueAsNumber: true })}
                      type={type}
                      className="form-control"
                      id={name}
                      placeholder={label}
                      step={"any"}
                    />
                    {errors[name] && <small className="text-danger">{errors[name]?.message}</small>}
                  </div>
                ))}
              </>
            )}

        </div>
      </form>
    </main>
  );
}

export default AddProduct;
