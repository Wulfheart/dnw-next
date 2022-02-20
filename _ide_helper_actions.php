<?php

namespace App\Actions\Game;

/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, \App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, \App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static void dispatchSync(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static void dispatchNow(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static void dispatchAfterResponse(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \App\Models\Game run(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 */
class CreateGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(int $game_id, bool $save_response)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(int $game_id, bool $save_response)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(int $game_id, bool $save_response)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, int $game_id, bool $save_response)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, int $game_id, bool $save_response)
 * @method static void dispatchSync(int $game_id, bool $save_response)
 * @method static void dispatchNow(int $game_id, bool $save_response)
 * @method static void dispatchAfterResponse(int $game_id, bool $save_response)
 * @method static mixed run(int $game_id, bool $save_response)
 */
class InitializeGameAction
{
}
namespace Lorisleiva\Actions\Concerns;

/**
 * @method void asController()
 */
trait AsController
{
}
/**
 * @method void asListener()
 */
trait AsListener
{
}
/**
 * @method void asJob()
 */
trait AsJob
{
}
/**
 * @method void asCommand(\Illuminate\Console\Command $command)
 */
trait AsCommand
{
}