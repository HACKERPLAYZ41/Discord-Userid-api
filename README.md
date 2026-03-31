# Discord Profile Lookup API

A Python-powered FastAPI + Discord.py bot that lets you fetch **detailed Discord user information** — including bio, pronouns, banners, badges, and linked accounts — through a REST API.  
Paired with a PHP/JS frontend (`lookup.php`) for a full profile viewer.

---

## 🌐 Live Preview

🚀 **Try it here:** [https://blockcode.space](https://blockcode.space)  
*(Hosted version running this exact code)*

---

## 🚀 Features

- **Fetch Discord Profile Data**
  - Username + discriminator
  - Avatar & banner (with fallback images)
  - Accent color
  - Public badges (HypeSquad, Staff, etc.)
  - Bio (About Me)
  - Pronouns (if available)
  - Linked accounts (YouTube, Twitch, etc.)

- **API Endpoints**
  - `/status` — Check if the API is running
  - `/user/{user_id}` — Get user info by Discord user ID

- **Works even if bot isn’t in the same server** (some fields may be unavailable)

---

## 📦 Requirements

- Python 3.10+ (tested on 3.12)
- A Discord Bot Token ([Get one here](https://discord.com/developers/applications))
- Installed dependencies from `requirements.txt`

---

## 📂 Installation

```bash
# 1. Clone the repo
git clone https://github.com/HACKERPLAYZ41/Discord-Userid-api.git
cd discord-profile-api

# 2. Create a virtual environment (optional but recommended)
python3 -m venv venv
source venv/bin/activate

# 3. Install dependencies
pip install -r requirements.txt

# 4. Create a .env file
echo "DISCORD_TOKEN=YOUR_DISCORD_BOT_TOKEN" > .env
echo "PORT=25003" >> .env
