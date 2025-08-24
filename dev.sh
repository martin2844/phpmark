#!/bin/bash

# PHPMark Framework Development Script

echo "🚀 Starting PHPMark Framework development environment..."

# Check if docker-compose is available
if ! command -v docker-compose &> /dev/null; then
    echo "❌ docker-compose not found. Please install Docker Compose."
    exit 1
fi

# Stop any existing containers
echo "🛑 Stopping existing containers..."
docker-compose -f docker-compose.dev.yml down 2>/dev/null

# Build and start the development container
echo "🔨 Building development container..."
docker-compose -f docker-compose.dev.yml up --build -d

# Wait a moment for startup
sleep 3

# Check if container is running
if docker-compose -f docker-compose.dev.yml ps | grep -q "Up"; then
    echo "✅ PHPMark Framework started successfully!"
    echo ""
    echo "📍 Site available at: http://localhost:3000"
    echo "📁 Files are mounted with hot reload enabled"
    echo "🔧 PHP OPcache configured for development (2s revalidation)"
    echo "🚫 All caching disabled for instant updates"
    echo ""
    echo "📝 To view logs: docker-compose -f docker-compose.dev.yml logs -f"
    echo "🛑 To stop: docker-compose -f docker-compose.dev.yml down"
    echo ""
    echo "📚 Edit includes/config.php to customize your site settings"
else
    echo "❌ Failed to start development server"
    echo "📋 Check logs: docker-compose -f docker-compose.dev.yml logs"
    exit 1
fi