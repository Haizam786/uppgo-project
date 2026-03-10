import heroImage from "../assets/explore/background.jpg";

function Hero() {
  return (
    <section className="relative min-h-screen overflow-hidden">
      {/* Background image */}
      <img
        src={heroImage}
        alt="Uppsala background"
        className="absolute inset-0 w-full h-full object-cover"
      />

      {/* Dark overlay */}
      <div className="absolute inset-0 bg-black/50"></div>

      {/* Content */}
      <div className="relative z-10 flex items-center justify-center min-h-screen text-white text-center px-6">
        <div className="max-w-3xl">
          <h1 className="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6">
            Discover Uppsala
          </h1>

          <p className="text-lg md:text-xl text-gray-200 mb-8">
            Explore events, culture, food, and experiences in one of Sweden’s
            most beautiful cities.
          </p>

          <button className="bg-white text-black px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition duration-300 shadow-lg">
            Explore More
          </button>
        </div>
      </div>
    </section>
  );
}

export default Hero;