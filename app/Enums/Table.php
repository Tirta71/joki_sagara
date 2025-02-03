<?php

namespace App\Enums;

enum Table: string
{
  case USERS = "users";
  case PASSWORD_RESET_TOKENS = "password_reset_tokens";
  case SESSIONS = "sessions";

  case LOCATIONS = 'locations';
  case CATEGORIES = 'categories';
  case FIXED_ASSETS = 'fixed_assets';
  case ACCU_DEPRECIATIONS = 'accumulation_depreciations';
  case DEPRECIATIONS = 'depreciations';
  case ASSETS = 'assets';
  case TRANSACTIONS = 'transactions';
  case HISTORY_TRANSACTION = 'history_transactions';
}
