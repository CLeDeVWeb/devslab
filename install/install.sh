
# DevLab Installer

set -e

# Configuration

DB_HOST="localhost"
DB_PORT="3306"
DB_USER="root"

BASE_DIR="$(cd "$(dirname "$0")/.." && pwd)"

SQL_INSTALL="${BASE_DIR}/install/sql/install.sql"
SQL_DATA="${BASE_DIR}/install/sql/data.sql"

# Couleurs

GREEN="\033[0;32m"
RED="\033[0;31m"
BLUE="\033[0;34m"
YELLOW="\033[1;33m"
NC="\033[0m"

# Mot de passe

read -s -p "Mot de passe MySQL : " DB_PASSWORD
echo

export MYSQL_PWD="$DB_PASSWORD"

# Fonctions

info()
{
    echo -e "${BLUE}[INFO]${NC} $1"
}

success()
{
    echo -e "${GREEN}[ OK ]${NC} $1"
}

error()
{
    echo -e "${RED}[ERREUR]${NC} $1"
}

execute_sql()
{
    local FILE="$1"

    info "Exécution de $(basename "$FILE")"

    docker exec \
        -e MYSQL_PWD="$MYSQL_PWD" \
        -i mysql \
        mysql \
        -h "$DB_HOST" \
        -P "$DB_PORT" \
        -u "$DB_USER" \
        < "$FILE"

    success "$(basename "$FILE") exécuté."
}

# Début

echo
echo "========================================================"
echo "              DevLab Installer"
echo "========================================================"
echo

# Vérification des fichiers

[ -f "$SQL_INSTALL" ] || { error "Fichier introuvable : $SQL_INSTALL"; exit 1; }
[ -f "$SQL_DATA" ] || { error "Fichier introuvable : $SQL_DATA"; exit 1; }

success "Scripts SQL trouvés."

# Vérification de MySQL

info "Connexion à MySQL..."

docker exec \
    -e MYSQL_PWD="$MYSQL_PWD" \
    -i mysql \
    mysql \
    -h "$DB_HOST" \
    -P "$DB_PORT" \
    -u "$DB_USER" \
    -e "SELECT VERSION();" > /dev/null

success "Connexion MySQL OK."

# Installation

execute_sql "$SQL_INSTALL"

execute_sql "$SQL_DATA"

unset MYSQL_PWD
# Fin
echo
echo "========================================================"
echo -e "${GREEN}Installation terminée avec succès.${NC}"
echo "========================================================"
echo