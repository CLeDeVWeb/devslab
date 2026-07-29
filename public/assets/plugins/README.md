# Plugins tiers

Ce dossier contient uniquement des bibliothèques externes utilisées par DevLab.

## Règles

- Les fichiers des bibliothèques ne doivent jamais être modifiés.
- Toute personnalisation est réalisée dans les fichiers CSS et JavaScript de DevLab.
- Les mises à jour consistent uniquement à remplacer les fichiers des bibliothèques.

## Bibliothèques utilisées

| Plugin | Utilisation |
|---------|-------------|
| Bootstrap | Grid responsive et utilitaires |
| Font Awesome | Icônes |
| jQuery | Manipulation DOM et plugins |
| DataTables | Tableaux interactifs |
| Flatpickr | Sélecteur de dates |
| SweetAlert2 | Boîtes de dialogue |
| TinyMCE | Éditeur HTML |
| Chart.js | Graphiques |

## Philosophie

Les bibliothèques tierces sont isolées dans ce dossier.

Le code métier, les composants graphiques (`dl-*`) et la logique JavaScript de DevLab sont développés indépendamment afin de faciliter les mises à jour et la maintenance.