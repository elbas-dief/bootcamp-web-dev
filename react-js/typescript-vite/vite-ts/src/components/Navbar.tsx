import { Link } from "react-router-dom";
import "./navbar.css";

export default function Navbar() {
    return (
        <nav style={{  }} className="">
            <Link to="/">Home</Link>
            <Link to="/about">About</Link>
            <Link to="/products">Products</Link>
        </nav>
    );
}