// import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
// import './index.css'
// import App from './App.tsx'
import { BrowserRouter, Route, Routes } from 'react-router-dom'
import Home from './pages/Home'
import Product from './pages/Product'
import About from './pages/About'
import MainLayout from './pages/MainLayout'

createRoot(document.getElementById('root')!).render(
  <BrowserRouter>
    {/* <App /> */}
    <Routes>
      <Route path="/" element={<MainLayout/>}>
        <Route path="/" element={<Home />} />
        <Route path="/products" element={<Product />} />
        <Route path="/about" element={<About />} />
      </Route>
    </Routes>
  </BrowserRouter>,
)
