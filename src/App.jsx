import { BrowserRouter, Route, Routes } from 'react-router-dom'
import './App.css'
import Products from './components/Products'
import AddProduct from './components/AddProduct'
import Footer from './components/Footer'

function App() {
  return (
    <>

    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Products />}/>
        <Route path="/add-product" element={<AddProduct />}/>
      </Routes>
    </BrowserRouter>
    <Footer/>

    </>
    
      
  )
}

export default App
