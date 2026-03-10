import { useState, useEffect } from "react";
import { NavLink } from "react-router-dom";

function Navbar() {
  const [scrolled, setScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 50);
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const openLaravelLogin = () => {
    window.open("/login", "_blank");
  };

  const linkBase =
    "relative text-gray-300 hover:text-white transition duration-300 group";

  return (
    <nav
      className={`fixed top-0 left-0 w-full z-50 transition-all duration-500 ${
        scrolled
          ? "bg-black/90 backdrop-blur-xl shadow-lg py-4"
          : "bg-black py-6"
      }`}
    >
      <div className="max-w-7xl mx-auto flex justify-between items-center px-6">
        <NavLink to="/" className="text-white text-2xl font-bold tracking-wide">
          UppGo
        </NavLink>

        <ul className="hidden md:flex space-x-10 items-center">
          <li>
            <NavLink to="/" className={linkBase}>
              Home
            </NavLink>
          </li>

          <li>
            <NavLink to="/events" className={linkBase}>
              Events
            </NavLink>
          </li>

          <li>
            <button onClick={openLaravelLogin} className={linkBase}>
              Login
            </button>
          </li>
        </ul>

        <button
          className="md:hidden flex flex-col justify-center items-center"
          onClick={() => setMenuOpen(!menuOpen)}
        >
          <span className="w-6 h-0.5 bg-white mb-1"></span>
          <span className="w-6 h-0.5 bg-white mb-1"></span>
          <span className="w-6 h-0.5 bg-white"></span>
        </button>
      </div>

      {menuOpen && (
        <div className="absolute top-full left-0 w-full bg-black flex flex-col items-center py-8 space-y-6 md:hidden">
          <NavLink
            to="/"
            onClick={() => setMenuOpen(false)}
            className="text-white"
          >
            Home
          </NavLink>

          <NavLink
            to="/events"
            onClick={() => setMenuOpen(false)}
            className="text-white"
          >
            Events
          </NavLink>

          <button
            onClick={() => {
              openLaravelLogin();
              setMenuOpen(false);
            }}
            className="text-white"
          >
            Login
          </button>
        </div>
      )}
    </nav>
  );
}

export default Navbar;