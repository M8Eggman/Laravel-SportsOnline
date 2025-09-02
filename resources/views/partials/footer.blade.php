<footer class="bd-footer py-5 mt-5 bg-dark text-light">
  <div class="container d-flex justify-content-center">
    <div class="d-flex gap-5 w-100">
      <div class="flex-grow-1">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Valorant_logo_-_pink_color_version.svg/2560px-Valorant_logo_-_pink_color_version.svg.png"
          class="mb-2" style="max-width: 50px" alt="">
        <p class="small mb-0">
          Designed and built with all the love
          <br /> in the world by
          <a href="" class="text-light">Cagatay & Saoussan</a>
        </p>
      </div>

      <div class="flex-grow-1 ">
        <h5>Links</h5>
        <ul class="list-unstyled mb-0">
          <li class="mb-2"><a href="/" class="text-light">Home</a></li>
          <li class="mb-2"><a href="{{ route('joueur.index') }}" class="text-light">Players</a></li>
          <li class="mb-2"><a href="{{ route('equipe.masculin.index') }}" class="text-light">Men's Team</a></li>
          <li class="mb-2"><a href="{{ route('equipe.feminin.index') }}" class="text-light">Women's Team</a></li>
          <li class="mb-2"><a href="{{ route('equipe.mixte.index') }}" class="text-light">Mixed Team</a></li>
        </ul>
      </div>

      <div class="flex-grow-1 ">
        <h5>Social Networks</h5>
        <ul class="list-unstyled mb-0">
          <li class="mb-2"><a href="" class="text-light">Facebook</a></li>
          <li class="mb-2"><a href="" class="text-light">Github</a></li>
          <li class="mb-2"><a href="" class="text-light">Linkedin</a></li>
          <li class="mb-2"><a href="" class="text-light">Twitter</a></li>
        </ul>
      </div>
    </div>

    <div class="py-4">
      <div class="container">
        <h4 class="mb-3">Subscribe to our Newsletter</h4>
        <p class="mb-4">Get the latest updates on our teams, players, and events directly in your inbox!</p>

        <form class="d-flex justify-content-center align-items-stretch gap-2 flex-wrap">
          <input type="email" class="form-control w-auto flex-grow-1" placeholder="Enter your email" required>
          <button class="btn btn-primary">Subscribe</button>
        </form>
      </div>
    </div>
  </div>
</footer>