import os
import discord
import uvicorn
import asyncio
from fastapi import FastAPI
from fastapi.responses import JSONResponse
from dotenv import load_dotenv

load_dotenv()

TOKEN = os.getenv("DISCORD_TOKEN")
PORT = int(os.getenv("PORT", 25003))

intents = discord.Intents.default()
client = discord.Client(intents=intents)
app = FastAPI()

@app.get("/user/{user_id}")
async def get_user(user_id: int):
    try:
        user = await client.fetch_user(user_id)
    except discord.NotFound:
        return JSONResponse({"error": "User not found"}, status_code=404)
    except discord.HTTPException as e:
        return JSONResponse({"error": str(e)}, status_code=500)

    # Fetch profile with bio, banner, pronouns, and connections
    profile = await client.fetch_user_profile(user.id)

    # Avatar
    avatar_url = user.avatar.url if user.avatar else f"https://cdn.discordapp.com/embed/avatars/0.png"

    # Banner
    banner_url = profile.banner.url if profile.banner else None

    # Connections
    connections = []
    for c in profile.connected_accounts:
        connections.append({
            "type": c.type,
            "name": c.name,
            "id": c.id
        })

    return {
        "id": str(user.id),
        "username": user.name,
        "discriminator": user.discriminator,
        "bot": user.bot,
        "avatar_url": avatar_url,
        "banner_url": banner_url,
        "accent_color": profile.accent_color.to_rgb() if profile.accent_color else None,
        "bio": profile.bio,
        "pronouns": profile.pronouns if hasattr(profile, "pronouns") else None,
        "connections": connections
    }

def start_api():
    uvicorn.run(app, host="0.0.0.0", port=PORT)

def start_bot():
    client.run(TOKEN)

if __name__ == "__main__":
    loop = asyncio.get_event_loop()
    loop.create_task(client.start(TOKEN))
    start_api()
