@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
  <div class="dash-grid">
    <!-- Confessions (Full width) -->
    <section class="dash-section span-full">
      <header class="dash-section-header">
        <div class="title"><i class="ri-user-voice-line"></i> Confessions</div>
        <a href="/confessions" class="link">View all</a>
      </header>
      <div class="card-list">
        <article class="card confession">
          <div class="card-body">
            <p class="text">“I finally spoke to the prof who inspired me to choose AI—turns out they’re super chill.”</p>
          </div>
          <footer class="card-meta">
            <span>42 reactions</span>
            <a href="/confessions" class="btn-sm">Post</a>
          </footer>
        </article>
        <article class="card confession tall">
          <div class="card-body">
            <p class="text">“Lost my way the first week on campus and found the best chai spot instead. 10/10 would get lost again.”</p>
          </div>
          <footer class="card-meta">
            <span>18 reactions</span>
            <a href="/confessions" class="btn-sm">Browse</a>
          </footer>
        </article>
        <article class="card confession">
          <div class="card-body">
            <p class="text">“Group study turned into group therapy—thanks for the laughs, Block B.”</p>
          </div>
          <footer class="card-meta">
            <span>5 reactions</span>
            <a href="/confessions" class="btn-sm">Read</a>
          </footer>
        </article>
        <article class="card confession wide">
          <div class="card-body">
            <p class="text">“To the person who left sticky notes with jokes in the library stacks—you made finals week survivable.”</p>
          </div>
          <footer class="card-meta">
            <span>Top this week</span>
            <a href="/confessions" class="btn-sm">See all</a>
          </footer>
        </article>
        <article class="card confession">
          <div class="card-body">
            <p class="text">“Every time I say ‘last chai’, it becomes a trilogy.”</p>
          </div>
          <footer class="card-meta">
            <span>9 reactions</span>
            <a href="/confessions" class="btn-sm">Read</a>
          </footer>
        </article>
        <article class="card confession tall">
          <div class="card-body">
            <p class="text">“I joined the coding club for snacks and stayed for the people. Also the snacks.”</p>
          </div>
          <footer class="card-meta">
            <span>27 reactions</span>
            <a href="/confessions" class="btn-sm">Browse</a>
          </footer>
        </article>
        <article class="card confession">
          <div class="card-body">
            <p class="text">“Campus peacocks are my emotional support birds.”</p>
          </div>
          <footer class="card-meta">
            <span>11 reactions</span>
            <a href="/confessions" class="btn-sm">Read</a>
          </footer>
        </article>
      </div>
    </section>

    <!-- Events (Small section) -->
    <section class="dash-section">
      <header class="dash-section-header">
        <div class="title"><i class="ri-calendar-event-line"></i> Events</div>
        <a href="/events" class="link">Open calendar</a>
      </header>
      <div class="card-list">
        <article class="card event">
          <div class="card-body">
            <div class="eyebrow">Oct 24 • 5:00 PM</div>
            <h3>Autumn Cultural Fest</h3>
            <p>Music, food stalls, and inter-department dance battle.</p>
          </div>
          <footer class="card-meta">
            <span>RSVPs 142</span>
            <a href="/events" class="btn-sm">RSVP</a>
          </footer>
        </article>
        <article class="card event">
          <div class="card-body">
            <div class="eyebrow">Oct 16 • 2:00 PM</div>
            <h3>Resume Clinic</h3>
            <p>Bring your resume for a peer + mentor review session.</p>
          </div>
          <footer class="card-meta">
            <span>RSVPs 58</span>
            <a href="/events" class="btn-sm">Details</a>
          </footer>
        </article>
      </div>
    </section>

  <!-- Marketplace (Full width, equal cards) -->
  <section class="dash-section span-full market-section">
      <header class="dash-section-header">
        <div class="title"><i class="ri-store-2-line"></i> Marketplace</div>
        <a href="/marketplace" class="link">Browse all</a>
      </header>
      <div class="card-list">
        <article class="card market">
          <div class="card-media"><img src="https://picsum.photos/seed/dsa/400/240" alt="DSA Book Set" /></div>
          <div class="card-body">
            <h3>DSA Book Set</h3>
            <p>Core topics covered; minimal highlights. Perfect for quick revision.</p>
          </div>
          <footer class="card-meta">
            <span>₹ 499</span>
            <div class="cta"><a href="/marketplace" class="btn-sm">View</a> <a href="/marketplace" class="btn-sm btn-ghost">Message</a></div>
          </footer>
        </article>
  <article class="card market">
          <div class="card-media"><img src="https://picsum.photos/seed/thinkpad/800/300" alt="Lenovo ThinkPad E14" /></div>
          <div class="card-body">
            <h3>Lenovo ThinkPad E14</h3>
            <p>Intel i5, 16GB RAM, 512GB SSD. Great battery; includes original charger.</p>
          </div>
          <footer class="card-meta">
            <span>₹ 29,500</span>
            <div class="cta"><a href="/marketplace" class="btn-sm">View</a> <a href="/marketplace" class="btn-sm btn-ghost">Chat</a></div>
          </footer>
        </article>
        <article class="card market">
          <div class="card-media"><img src="https://picsum.photos/seed/kit/400/240" alt="Hostel Essentials Kit" /></div>
          <div class="card-body">
            <h3>Hostel Essentials Kit</h3>
            <p>Kettle (1.5L), extension board (6-port), LED lamp. Ideal starter bundle.</p>
          </div>
          <footer class="card-meta">
            <span>₹ 999</span>
            <div class="cta"><a href="/marketplace" class="btn-sm">View</a> <a href="/marketplace" class="btn-sm btn-ghost">Chat</a></div>
          </footer>
        </article>
        <article class="card market">
          <div class="card-media"><img src="https://picsum.photos/seed/calc/400/240" alt="Scientific Calculator FX-991EX" /></div>
          <div class="card-body">
            <h3>Scientific Calculator FX-991EX</h3>
            <p>Nearly new, protective case included. Exam-ready.</p>
          </div>
          <footer class="card-meta">
            <span>₹ 1,200</span>
            <div class="cta"><a href="/marketplace" class="btn-sm">View</a> <a href="/marketplace" class="btn-sm btn-ghost">Message</a></div>
          </footer>
        </article>
      </div>
    </section>

    <!-- Lost & Found (Small section) -->
    <section class="dash-section">
      <header class="dash-section-header">
        <div class="title"><i class="ri-search-eye-line"></i> Lost &amp; Found</div>
        <a href="/lost-found" class="link">See board</a>
      </header>
      <div class="card-list">
        <article class="card lost">
          <div class="card-body">
            <h3>Lost: Black Wallet</h3>
            <p>Last seen near Library Cafe, brown leather interior.</p>
          </div>
          <footer class="card-meta">
            <span>2 comments</span>
            <a href="/lost-found" class="btn-sm">Details</a>
          </footer>
        </article>
        <article class="card found tall">
          <div class="card-body">
            <h3>Found: USB-C Charger</h3>
            <p>Picked up in Block A lab 204. Describe sticker to claim.</p>
          </div>
          <footer class="card-meta">
            <span>Waiting claimant</span>
            <a href="/lost-found" class="btn-sm">Claim</a>
          </footer>
        </article>
        <article class="card lost">
          <div class="card-body">
            <h3>Lost: ID Card</h3>
            <p>Name: Riya. Likely dropped near auditorium.</p>
          </div>
          <footer class="card-meta">
            <span>3 comments</span>
            <a href="/lost-found" class="btn-sm">Details</a>
          </footer>
        </article>
      </div>
    </section>

    <!-- Ride Sharing -->
    <section class="dash-section">
      <header class="dash-section-header">
        <div class="title"><i class="ri-car-line"></i> Ride Sharing</div>
        <a href="/carpooling" class="link">Find a ride</a>
      </header>
      <div class="card-list">
        <article class="card ride">
          <div class="card-body">
            <div class="eyebrow">Shimla → Campus • 7:30 AM</div>
            <p>2 seats available. No luggage.</p>
          </div>
          <footer class="card-meta">
            <span>By Aman</span>
            <a href="/carpooling" class="btn-sm">Join</a>
          </footer>
        </article>
        <article class="card ride">
          <div class="card-body">
            <div class="eyebrow">Solan → Campus • 9:00 AM</div>
            <p>1 seat, music ok.</p>
          </div>
          <footer class="card-meta">
            <span>By Neha</span>
            <a href="/carpooling" class="btn-sm">Join</a>
          </footer>
        </article>
      </div>
    </section>

    <!-- Accommodation -->
    <section class="dash-section">
      <header class="dash-section-header">
        <div class="title"><i class="ri-home-5-line"></i> Accommodation</div>
        <a href="/accommodation" class="link">Find room</a>
      </header>
      <div class="card-list">
        <article class="card room">
          <div class="card-body">
            <h3>Room near Gate 2</h3>
            <p>2BHK shared • Wi‑Fi • Laundry</p>
          </div>
          <footer class="card-meta">
            <span>₹ 4,800/mo</span>
            <a href="/accommodation" class="btn-sm">View</a>
          </footer>
        </article>
      </div>
    </section>
  </div>
@endsection
