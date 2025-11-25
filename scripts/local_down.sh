#!/bin/bash

# CV Project Local Down Script
# This script stops and removes the local development environment

set -euo pipefail

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Get script directory
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"

echo -e "${BLUE}🛑 Останавливаю локальную среду CV Project...${NC}"

cd "$PROJECT_ROOT"
docker compose -f "$PROJECT_ROOT/docker-compose.yml" down

echo -e "${GREEN}✅ Локальная среда остановлена${NC}"
echo -e "${YELLOW}💡 Для полной очистки (включая volumes) используйте:${NC}"
echo -e "   docker compose down -v"
