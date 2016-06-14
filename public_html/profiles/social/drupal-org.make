# Examples:
# https://raw.githubusercontent.com/drush-ops/drush/master/examples/example.make.yml

# Core version
# ------------
# Each makefile should begin by declaring the core version of Drupal that all
# projects should be compatible with.

core: 8.x

# API version
# ------------
# Every makefile needs to declare it's Drush Make API version. This version of
# drush make uses API version `2`.
api: 2

# Defaults
# ------------
# Set defaults for the make file.

defaults:
  projects:
    subdir: 'contrib'

# Modules
# ------------
# All dependencies with latest versions we use. If we do not add the versions we will not have a stable build
# on all the environments.
projects:
  address:
    version: 1.0-beta2
  admin_toolbar:
    version: '1.14'
  config_update:
    version: '1.1'
  composer_manager:
    version: 1.0-rc1
  devel:
    version: 1.x-dev
  entity:
    version: 1.0-alpha2
  features:
    version: 3.0-beta3
  field_group:
    version: 1.0-rc4
  group:
    version: 1.x-dev
  override_node_options:
    version: '2.0'
  profile:
    version: 1.0-alpha4
    patch:
      - 'https://www.drupal.org/files/issues/profile-accesscontrol-2703825-2.patch'
      - 'https://www.drupal.org/files/issues/profile-page-title-missing-2704763-3.patch'
  r4032login:
    version: 1.x-dev
  search_api:
    version: 1.0-alpha14

# Themes
  bootstrap:
    type: theme
    version: 3.x-dev

# Libraries
libraries:
  addressing:
    download:
      type: git
      tag: v0.8.2
      url: "https://github.com/commerceguys/addressing.git"
    destination: vendor
    directory_name: commerceguys/addressing
  zone:
    download:
      type: git
      tag: v0.7.1
      url: "https://github.com/commerceguys/zone.git"
    destination: vendor
    directory_name: commerceguys/zone
  intl:
    download:
      type: git
      tag: v0.7.1
      url: "https://github.com/commerceguys/intl.git"
    destination: vendor
    directory_name: commerceguys/intl

# @Todo add theme as a dependency once it's correctly released and released?
