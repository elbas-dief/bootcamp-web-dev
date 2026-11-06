import Header from './components/Header'
import Counter from './components/Counter'
import Footer from './components/Footer'
import './App.css'

function App() {
  return (
    <>
      <section id="center">
        <Header />
        <Counter />
      </section>

      <div className="ticks"></div>

      <Footer />

      <div className="ticks"></div>
      <section id="spacer"></section>
    </>
  )
}

export default App
